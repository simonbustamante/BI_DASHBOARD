<?php

namespace App\Controller;

use App\Document\FarmerInformation;
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
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;

class ProductUnitSalesController extends AbstractController
{

    #[Route('/product/unit/sales/', name: 'product_unit_sales')]
    public function index(DocumentManager $dm,Request $request, ChartBuilderInterface $chartBuilder): Response
    {   
        $form = $this->createForm(FarmerSellDetailType::class, null);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $farmerId = $form['farmer_id']->getData();
            $startDate = $form['start_invoice_date']->getData();
            $endDate = $form['end_invoice_date']->getData();
            $chartType = $form['report_type']->getData();
            if($startDate <= $endDate)
            {
                $this->addFlash('success','The chart has been generated.');
                $chart = $this->setChartType($chartBuilder,$chartType);
                if($farmerId == 'all')
                {
                    $sellArray = $this->getAllFarmerSellDetail($dm,$startDate,$endDate);
                }
                else
                {
                    $sellArray = $this->getFarmerSellDetail($dm,$farmerId,$startDate,$endDate);
                }
                $farmerProducts = $this->getFarmerProducts($sellArray);
                $productUnitSales = $this->getFarmerProductSalesDetail($dm, $farmerProducts, $startDate, $endDate);
                $farmerData = $this->getFarmerData($productUnitSales);
                $chartData = $this->getArrangeChartProductUnitSales($farmerData,$farmerProducts,$startDate,$endDate);    
                dump($chartData);
            }
            else
            {
                $this->addFlash('fail','End invoice date can\'t be greater than start invoice date');
                return $this->redirectToRoute('sales_quantity');
            }
            $chart = $this->setChartData($chart, $chartData);
        }
        else
        {
            $chart = $chartBuilder->createChart(Chart::TYPE_PIE);
            $chart = $this->setChartData($chart,$this->datadummy());
        }
        $chart = $this->setChartOptions($chart);
        //dump($chart);die();
        return $this->render('dashboard/farmer-sell-weight.html.twig', [
            'orders_time_line' => $chart,
            'form' => $form->createView()
        ]);
    }

    private function datadummy()
    {
        for($i = 0 ; $i < 4  ; $i++)
        {
            $x[$i] = $i." hola ";
            $y[$i] = $i;
            
        }
        dump($x);dump($y);
        return [
            'labels' => $x,
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $y,
                ],
                
            ],
        ];
    }

    private function getFarmerData($productSales)
    {

        foreach($productSales as $keyProd => $product)
        {
            foreach($product as $key => $sell)
            {
                $invoice = $sell->getInvoiceDate();
                $invoice = $invoice->format('Y-m-d');
                $farmer[$keyProd][$key]['product_quantity'] = $sell->getProductQuantity();
                $farmer[$keyProd][$key]['invoice'] = $invoice;
                $farmer[$keyProd][$key]['product_id'] = $sell->getProductId();
                $farmer[$keyProd][$key]['product_name'] = $sell->getProductName();
            }
        }
        //dump($farmer);die();
        return $farmer; 
    }

    private function getArrangeChartProductUnitSales($array,$farmerProducts,$startDate, $endDate)
    {
        $period = new DatePeriod($startDate,new DateInterval('P1D'),$endDate);
        foreach ($period as $key => $value) 
        {
            $days[$key] = $value->format('Y-m-d');
        }
        //dump($farmerProducts);die();
        $i = 0;
        foreach($farmerProducts as $product)
        {
            foreach($days as $day)
            {
                $count = 0;
                foreach($array as $key => $prod)
                {
                    foreach($prod as $aux => $v)
                    {
                        if($day == $v['invoice'] && $product['product_id'] == $v['product_id'])
                        {
                            //$i++;
                            $count = $v['product_quantity'] + $count;
                        }
                        //dump($v);        
                    }
                    $productCount[$product['product_id']][$day] = $count;
                }
            }
           
              
            $datasets[$i++] = [
                    'label' => $product['product_name'],
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => []
            ];
          
        }
       
        
        $j = 0;
        foreach($productCount as $key => $ds)
        {
            $key = $j++;
            $color = $this->generateColor();
            $color = $color[rand(0,6)];
            $datasets[$key]['backgroundColor'] = $color;
            $datasets[$key]['borderColor'] = $color;
            $datasets[$key]['data'] = $ds;
        }
        
        $arrayData = [
            'labels' => $days,
            'datasets' => $datasets
        ];
        
        return $arrayData;
    }

    private function generateColor()
    {
        $result = [
            '0' => 'rgb(255, 99, 132)',
            '1' => 'rgb(0, 255, 255)',
            '2' => 'rgb(0, 255, 0)',
            '3' => 'rgb(255, 255, 0)',
            '4' => 'rgb(0, 0, 255)',
            '5' => 'rgb(255, 0, 255)',
            '6' => 'rgb(128, 128, 128)',

        ];
        return $result;
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

    private function getFarmerProductSalesDetail(DocumentManager $dm, $product, $startTime, $endTime)
    {
        foreach($product as $key => $prod)
        {
            $farmerSell = $dm->createQueryBuilder(FarmerSellDetail::class)
                ->field('productId')->equals($prod['product_id'])
                ->field('invoiceDate')->range($startTime,$endTime)
                ->getQuery()       
                ->execute();
            $farmer[$key] = $farmerSell->toArray();
        }
        //dump($farmer);die();
        return $farmer;
    }

    private function getFarmerProducts($sellArray)
    {
        $i = 0;
        foreach($sellArray as $sell)
        {
            $productName[$i] = $sell->getProductName();
            $product[$i++] = $sell->getProductId();
        }
        $product = array_unique($product);
        $productName = array_unique($productName);

        foreach($product as $key => $prod)
        {
            $productList[$key]['product_id'] = $prod;
            $productList[$key]['product_name'] = $productName[$key]; 
        }
        return $productList;
    }

    private function getFarmerSellDetail(DocumentManager $dm,$farmerId, $startTime, $endTime)
    {
        $farmerSell = $dm->createQueryBuilder(FarmerSellDetail::class)
            ->field('farmerId')->equals($farmerId)
            ->field('invoiceDate')->range($startTime,$endTime)
            ->getQuery()       
            ->execute();
        $farmer = $farmerSell->toArray();
        return $farmer;

    }

    private function setChartData(Chart $chart, $data)
    {
        $chart->setData($data);

        return $chart;
    }

    private function setChartOptions($chart, $min = 0, $max = 100)
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
