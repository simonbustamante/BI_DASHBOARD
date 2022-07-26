<?php

namespace App\Controller\Report;

use App\Document\FarmerInformation;
use App\Document\FarmerProduct;
use App\Document\FarmerProfile;
use App\Document\FarmerSellDetail;
use App\Form\Model\Search;
use App\Form\Type\FarmerSellDetailType;
use App\Form\Type\SearchType;
use App\Repository\GeneralRepository;
use DateInterval;
use DatePeriod;
use DateTime;
use Doctrine\ODM\MongoDB\DocumentManager;
use PhpParser\Node\Stmt\Return_;
use Symfony\Bridge\Twig\Node\DumpNode;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Knp\Component\Pager\PaginatorInterface;
use Dompdf\Dompdf;
use Dompdf\Options;

class SalesQuantityController extends AbstractController
{
    private $paginator;

    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    #[Route('/', name: 'sales_quantity')]
    public function index(DocumentManager $dm, Request $request, ChartBuilderInterface $chartBuilder): Response
    {
           
        $form = $this->createForm(FarmerSellDetailType::class, null,[
            'action' => $this->generateUrl('sales_quantity'),
            'method' => 'GET'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $farmerId = $form['farmer_id']->getData();
            $startDate = $form['start_invoice_date']->getData();
            $endDate = $form['end_invoice_date']->getData();
            if($startDate <= $endDate)
            {
                if($farmerId != "all")
                {
                    $chart = $this->setChartType($chartBuilder,"TYPE_LINE");
                    $pieChart = $this->setChartType($chartBuilder,"TYPE_PIE");
                    $sellArray = $this->getFarmerSellDetail($dm,$farmerId,$startDate,$endDate);
                    if(empty($sellArray))
                    {
                        $this->addFlash('warning','Please select other dates since there is no data related to these dates');
                        return $this->redirectToRoute('sales_quantity');
                    }
                    $dataTable = $this->generateDataTable($sellArray,$request);
                    $productTotal = $this->generateProductData($sellArray,$farmerId,$dm);
                    $this->addFlash('success','The chart has been generated.');
                    $invoiceDates = $this->getFarmerInvoicesDates($sellArray);
                    $axes = $this->getChartSalesQuantity($invoiceDates,$startDate,$endDate); 
                    $farmerProducts = $this->getFarmerProductSales($sellArray);
                }
                else
                {
                    $this->addFlash('warning','Please select a farmer');
                    return $this->redirectToRoute('sales_quantity');
                }
            }
            else
            {
                $this->addFlash('fail','End invoice date can\'t be greater than start invoice date');
                return $this->redirectToRoute('sales_quantity');
            }
            
            $pieChart = $this->setPieChartData($pieChart,$farmerProducts, 'Total product sales over the time');
            $chart = $this->setChartData($chart, 'Order amount over time', $axes['labels'], $axes['data']);
        }
        else
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
            $pieChart = $chartBuilder->createChart(Chart::TYPE_PIE);
            $chart = $this->setChartData($chart,'Order amount over time');
            $pieChart = $this->setPieChartData($pieChart,null,'Total product sales over the time');
            $dataTable = $dataTable = $this->generateDataTable([],$request);
            $productTotal = [];
            $farmerId = "none";
            $startDate = "";
            $endDate = "";
            
        }

        $chart = $this->setChartOptions($chart);
        $pieChart = $this->setChartOptions($pieChart);
       
        return $this->render('dashboard/farmer-sell.html.twig', [
            'orders_time_line' => $chart,
            'product_time_line' => $pieChart,
            'form' => $form->createView(),
            'data_table' => $dataTable,
            'product_total' => $productTotal,
            'farmerId' => $farmerId,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    

    #[Route('/exp-csv/{farmerId}/{startDate}/{endDate}', name: 'exp_csv')]
    public function exportCsv($farmerId,$startDate,$endDate, DocumentManager $dm)
    {
        dump($farmerId);
        $rows = array();
        if($farmerId != "none")
        {
            $farmer = $this->getFarmerSellDetail($dm,$farmerId,$startDate,$endDate);
            foreach($farmer as $dat)
            {
                $data = array( 
                    $dat->getFarmerId(),
                    $dat->getIdOrder(),
                    $dat->getInvoiceDate()->format('Y-m-d'),
                    $dat->getProductName(),
                    $dat->getProductQuantity(),
                    "$".$dat->getProductPrice(),
                    "$".($dat->getProductQuantity() * $dat->getProductPrice()),
                );
                $rows[] = implode(',', $data);    
            }
        }
        $content = implode("\n", $rows);
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        return $response;
    }
    private function dummyData()
    {   
        $data = [
            'labels' => ['January 1','January 2','January 3','January 4'],
            'datasets' => [
                [
                    'label' => 'My First dataset 1',
                    'backgroundColor' => ['rgb(255, 0, 0)','rgb(255, 255, 0)','rgb(255, 99, 132)','rgb(0, 0, 255)'],
                    'borderColor' => ['rgb(255, 0, 0)','rgb(255, 255, 0)','rgb(255, 99, 132)','rgb(0, 0, 255)'],
                    'data' => [345,400,600,100],
                ],
            ],
        ];



        return $data;
    }


    private function getFarmerProductSales($sellArray)
    {
        $i = 0;
        foreach($sellArray as $sell)
        {
            $all['product_name'][$i] = $sell->getProductName();
            $all['product_id'][$i] = $sell->getProductId();
            $all['product_quantity'][$i++] = $sell->getProductQuantity();
        }
        
        $product = array_unique($all['product_id']);
        $productName = array_unique($all['product_name']);
        
        foreach($product as $key => $prod)
        {
            $productList[$key]['product_id'] = $prod;
            $productList[$key]['product_name'] = $productName[$key];
            
            foreach($all['product_id'] as $akey => $pid)
            {
                if($prod == $pid)
                {
                    $productList[$key]['product_quantity'][$akey] = $all['product_quantity'][$akey];
                }
            }
        }
        //dump($productList);die();
            
        return $productList;
    }
    

    private function generateDataTable($farmerSell,$request)
    {
        $limit = "10";
        $page = $request->query->getInt('page',1);
        return $this->paginator->paginate($farmerSell,$page,$limit);
    }

    private function generateProductData($sellArray,$farmerId,$dm)
    {
        $i = 0;
        foreach($sellArray as $sell)
        {
            $all['product_name'][$i] = $sell->getProductName();
            $all['product_id'][$i] = $sell->getProductId();
            $all['product_quantity'][$i] = $sell->getProductQuantity();
            $all['product_sell_amount'][$i] = $sell->getProductQuantity() * $sell->getProductPrice();
            $i++;
        }
        $farmerProducts = $this->getFarmerProductDescription($dm, $farmerId);
        
        $product = array_unique($all['product_id']);
        $productName = array_unique($all['product_name']);
        foreach($product as $key => $prod)
        {
            $productList[$key]['product_id'] = $prod;
            $productList[$key]['product_name'] = $productName[$key];
            
            foreach($all['product_id'] as $akey => $pid)
            {
                if($prod == $pid)
                {
                    if(isset($productList[$key]['product_sell_amount']))
                    {
                        $productList[$key]['product_sell_amount'] = 
                            $all['product_sell_amount'][$akey] +
                            $productList[$key]['product_sell_amount'];
                    }
                    else
                    {
                        $productList[$key]['product_sell_amount'] = $all['product_sell_amount'][$akey];
                    }
                }
            }
            
        }
        foreach($productList as $key => $list)
        {
            foreach($farmerProducts as $fp)
            {
                if($list['product_id'] == $fp->getProductId())
                {
                    $finalList[$key]['product_id'] = $fp->getProductId();
                    $finalList[$key]['product_name'] = $fp->getProductName();
                    $finalList[$key]['product_sell_amount'] = $list['product_sell_amount'];
                    $finalList[$key]['product_activity'] = $fp->getActivityName();
                }
            }
        }
        
        
        return $finalList;
    }

    private function getChartSalesQuantity($array,$startDate, $endDate)
    {
        $period = new DatePeriod($startDate,new DateInterval('P1D'),$endDate);
        foreach ($period as $key => $value) 
        {
            $days[$key] = $value->format('Y-m-d');
        }
        //dump($array);
        foreach($days as $day)
        {
            $i = 0;
            foreach($array as $aux)
            {
                if($day == $aux)
                {
                    $i++; 
                }
            }
            $count[$day] = $i;
        }
        //dump($count);
        return [
            'labels' => $days,
            'data' => $count
        ];
    }

    private function arrangePieChartProductSales($farmerProducts)
    {
        dump($farmerProducts);die();
        foreach($farmerProducts as $key => $fp)
        {
            $labels[$key] = $fp['product_name'];
            $data[$key] = $fp['product_quantity'];
        }
        return [
            'labels' => $labels,
            'data' => $data
        ];
    }

    private function getAllFarmerSellDetail(DocumentManager $dm, $startTime, $endTime)
    {
        $farmerSell = $dm->createQueryBuilder(FarmerSellDetail::class)
            ->field('invoiceDate')->range($startTime,$endTime)
            ->getQuery()       
            ->execute();
        $farmer = $farmerSell->toArray();
        return $farmer;

    }

    private function getFarmerInvoicesDates($sellArray)
    {
        $i = 0;
        foreach($sellArray as $sell)
        {
            $invoice = $sell->getInvoiceDate();
            $invoice = $invoice->format('Y-m-d');
            $invoiceDates[$i++] = $invoice;
        }
        return $invoiceDates; 
    }

    private function getFarmerSellDetail(DocumentManager $dm,$farmerId, $startTime, $endTime)
    {
        $farmerSell = $dm->createQueryBuilder(FarmerSellDetail::class)
            ->field('farmerId')->equals($farmerId)
            ->field('invoiceDate')->range($startTime,$endTime)
            ->sort('productId','ASC')
            ->getQuery()       
            ->execute();
        $farmer = $farmerSell->toArray();
        return $farmer;

    }

    private function getFarmerProductDescription(DocumentManager $dm, $farmerId)
    {
        $farmerProducts = $dm->createQueryBuilder(FarmerProduct::class)
            ->field('farmerId')->equals($farmerId)
            ->sort('productId','ASC')
            ->getQuery()
            ->execute();
        $farmerProducts = $farmerProducts->toArray();
        return $farmerProducts;
    }

    private function setChartData(Chart $chart, $reportName, $labels = [], $data = [], $backC = 'rgb(255, 99, 132)', $borderC = 'rgb(255, 99, 132)')
    {
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => $reportName,
                    'backgroundColor' => $backC,
                    'borderColor' => $borderC,
                    'data' => $data,
                ],
            ],
        ]);

        return $chart;
    }
    private function setPieChartData(Chart $chart,$data = null, $reportName, $backC = 'rgb(255, 99, 132)', $borderC = 'rgb(255, 99, 132)')
    {
        $backC = ['rgb(255, 0, 0)','rgb(255, 255, 0)','rgb(0, 255, 255)','rgb(0, 0, 255)'];
        $borderC = ['rgb(255, 0, 0)','rgb(255, 255, 0)','rgb(0, 255, 255)','rgb(0, 0, 255)'];
        $i=0;
        if($data == NULL)
        {
            $totalProduct = [];
            $labels = [];
        }
        else{
            foreach($data as $key => $d)
            {
                $labels[$i] = $d['product_name'];
                foreach($d['product_quantity'] as $pq)
                {
                    if(isset($totalProduct[$i]))
                    {
                        $totalProduct[$i]  = $totalProduct[$i] + $pq;
                    }
                    else{
                        $totalProduct[$i]  = $pq;
                    }
                }
                $i++;
            }
        }
        $datasets =  [
            'label' => $reportName,
            'backgroundColor' => $backC,
            'borderColor' => $borderC,
            'data' => $totalProduct,
        ];
        $chart->setData([
            'labels' => $labels,
            'datasets' => ['0'=>$datasets]
        ]);

        return $chart;
    }

    private function setChartOptions($chart, $min = 0, $max = 4)
    {
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => $min,
                    'suggestedMax' => $max,
                ],
            ],
        ]);

        return $chart;
    }

    private function setChartType(ChartBuilderInterface $chartBuilder, $chartType)
    {
        if($chartType == 'TYPE_LINE')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_LINE);
        }
        elseif($chartType == 'TYPE_BAR')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        }
        elseif($chartType == 'TYPE_BUBBLE')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_BUBBLE);
        }
        elseif($chartType == 'TYPE_DOUGHNUT')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        }
        elseif($chartType == 'TYPE_PIE')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_PIE);
        }
        elseif($chartType == 'TYPE_POLAR_AREA')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_POLAR_AREA);
        }
        elseif($chartType == 'TYPE_RADAR')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_RADAR);
        }
        elseif($chartType == 'TYPE_SCATTER')
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_SCATTER);
        }
        return $chart;
    }
}
