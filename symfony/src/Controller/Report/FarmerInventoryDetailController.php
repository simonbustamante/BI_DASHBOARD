<?php

namespace App\Controller\Report;

use App\Document\FarmerInventoryUpdate;
use App\Document\FarmerProduct;
use App\Document\MayaniInventory;
use App\Form\Type\FarmerType;
use DateInterval;
use DatePeriod;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Knp\Component\Pager\PaginatorInterface;

class FarmerInventoryDetailController extends AbstractController
{
    private $paginator;

    public function __construct(PaginatorInterface $paginator)
    {
        $this->paginator = $paginator;
    }

    #[Route('/inventory', name: 'farmer_inventory')]
    public function index(DocumentManager $dm, Request $request, ChartBuilderInterface $chartBuilder): Response
    {
        $form = $this->createForm(FarmerType::class, null,[
            'action' => $this->generateUrl('farmer_inventory'),
            'method' => 'GET'
        ]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid())
        {
            $farmerId = $form['farmer_id']->getData();
            $startDate = $form['start_date']->getData();
            $endDate = $form['end_date']->getData();
            if($startDate <= $endDate)
            {
                if($farmerId != "all")
                {
                    $inventoryArray = $this->getFarmerInventoryUpdate($dm,$farmerId,$startDate,$endDate);
                    if(empty($inventoryArray))
                    {
                        $this->addFlash('warning','Please select other dates since there is no data related to these dates');
                        return $this->redirectToRoute('farmer_inventory');
                    }
                    $mayaniArray = $this->getMayaniRequestData($dm,$farmerId,$startDate,$endDate);
                        dump($mayaniArray);die();
                    $farmerProducts = $this->getFarmerProduct($dm, $farmerId);

                    //first chart and piechart
                    $chart = $this->setChartType($chartBuilder,"TYPE_LINE");
                    $pieChart = $this->setChartType($chartBuilder,"TYPE_PIE");
                    $inventoryDate = $this->getFarmerInventoryDatesPerProduct($inventoryArray, $farmerProducts);
                        //dump($inventoryDate);die();
                    $data = $this->getChartInventoryUpdateData($inventoryDate,$farmerProducts,$startDate,$endDate);
                    $farmerInventoryUpdateQuantity = $this->getFarmerProductInventoryUpdate($inventoryArray,$farmerProducts);
                    $dataTable = $this->generateDataTable($inventoryArray,$request);

                    //second chart and pie chart
                    $chart2 = $this->setChartType($chartBuilder,"TYPE_LINE");
                    $pieChart2 = $this->setChartType($chartBuilder,"TYPE_PIE");
                    $b2cRequests = $this->getMayaniB2cRequestsPerProduct($mayaniArray, $farmerProducts);
                        //dump($b2cRequests);die();
                    $data2 = $this->getChartMayaniB2cRequestData($b2cRequests,$farmerProducts,$startDate,$endDate);

                    $this->addFlash('success','The report has been generated.');
                }
                else{
                    $this->addFlash('warning','Please select a farmer');
                    return $this->redirectToRoute('farmer_inventory');
                }    

            }
            else{
                $this->addFlash('fail','End date can\'t be greater than start date');
                return $this->redirectToRoute('farmer_inventory');
            }
            $chart = $this->setChartData($chart, $data);
            $pieChart = $this->setPieChartData($pieChart,$farmerInventoryUpdateQuantity,'Quantity of inventory updated over time');
            $chart2 = $this->setChartData($chart2, $data2);
        }
        else{
            $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
            $chart2 = $chartBuilder->createChart(Chart::TYPE_BAR);
            $pieChart = $chartBuilder->createChart(Chart::TYPE_PIE);
            //$chart = $chart->setData($this->dummyData());
            $chart = $this->setChartData($chart,[]);
            $chart2 = $this->setChartData($chart2,[]);
            $pieChart = $this->setPieChartData($pieChart,null,'Quantity of inventory updated over time');
            $dataTable = $this->generateDataTable([],$request);
            $startDate = "";
            $endDate = "";
            
        }
        $chart = $this->setChartOptions($chart);
        $chart2 = $this->setChartOptions($chart2);
        $pieChart = $this->setChartOptions($pieChart);
        return $this->render('inventory/farmer-inventory.html.twig', [
            'form' => $form->createView(),
            'startDate' => $startDate,
            'endDate' => $endDate,
            'inventory_time_line' => $chart,
            'b2c_time_line' => $chart2,
            'inventory_quantity' => $pieChart,
            'data_table' => $dataTable,
        ]);
    }

    private function dummyData()
    {   
        // $data = [
        //     'labels' => ['January 1','January 2','January 3','January 4'],
        //     'datasets' => [
        //         [
        //             'label' => 'My First dataset 1',
        //             'backgroundColor' => ['rgb(255, 0, 0)','rgb(255, 255, 0)','rgb(255, 99, 132)','rgb(0, 0, 255)'],
        //             'borderColor' => ['rgb(255, 0, 0)','rgb(255, 255, 0)','rgb(255, 99, 132)','rgb(0, 0, 255)'],
        //             'data' => [345,400,600,100],
        //         ],
        //     ],
        // ];

        $data = [
            'labels' => ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
            'datasets' => [
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => [1, 10, 5, 2, 20, 30, 45],
                ],
                [
                    'label' => 'My First dataset',
                    'backgroundColor' => 'rgb(255, 0, 0)',
                    'borderColor' => 'rgb(255, 0, 0)',
                    'data' => [2, 10, 5, 2, 20, 30, 45],
                ],
            ],
        ];
        return $data;
    }
    private function generateDataTable($inventoryArray,$request)
    {
        $limit = "5";
        $page = $request->query->getInt('page',1);
        return $this->paginator->paginate($inventoryArray,$page,$limit);
    }
    private function getFarmerProductInventoryUpdate($inventoryArray,$farmerProducts)
    {
        $i = 0;
        foreach($farmerProducts as $pkey => $product)
        {
            $i=0;
            foreach($inventoryArray as $inventory)
            {
                if($product->getInventoryId() == $inventory->getInventoryId())
                {
                    $all[$pkey]['product_name'][$i] = $product->getProductName();
                    $all[$pkey]['product_id'][$i] = $product->getProductId(); 
                    $all[$pkey]['quantity_kg'][$i++] = $inventory->getQuantityKg(); 
                }
            }
        }
        
        foreach($farmerProducts as $key => $prod)
        {
            $productList[$key]['product_id'] = $prod->getProductId();
            $productList[$key]['product_name'] = $prod->getProductName();   
            foreach($all as $akey => $pid)
            {
                $productList[$key]['quantity_kg'] = array_sum($pid['quantity_kg']);
            }
            
        }         
        return $productList;
    }

    private function getFarmerProduct(DocumentManager $dm, $farmerId)
    {
        $farmerProducts = $dm->createQueryBuilder(FarmerProduct::class)
            ->field('farmerId')->equals($farmerId)
            ->sort('productId','ASC')
            ->getQuery()
            ->execute();
        $farmerProducts = $farmerProducts->toArray();

        //dump($farmerProducts);die();
        return $farmerProducts;
    }

    private function getChartMayaniB2cRequestData($b2cRequests,$farmerProducts,$startDate,$endDate)
    {
        $period = new DatePeriod($startDate,new DateInterval('P1D'),$endDate);
        foreach ($period as $key => $value) 
        {
            $days[$key] = $value->format('Y-m-d');
        }
        foreach ($days as $kday => $day)
        {
            foreach($b2cRequests as $ikey => $b2cR)
            {
                $i = 0;
                foreach($b2cR['b2c_product_request_date'] as $dates)
                {
                    if($dates == $day)
                    {
                        $i++;
                    }
                }
                $count[$kday][$ikey]['count'] = $i;
                $count[$kday][$ikey]['product_id'] = $b2cRequests[$ikey]['product_id'][0];
                $count[$kday][$ikey]['product_name'] = $b2cRequests[$ikey]['product_name'][0];
                $count[$kday][$ikey]['inventory_id'] = $b2cRequests[$ikey]['inventory_id'][0];
                $count[$kday][$ikey]['b2c_product_request_date'] = $b2cRequests[$ikey]['b2c_product_request_date'][0];
            }
        }
        foreach($farmerProducts as $pkey => $product)
        {
            foreach($count as $kday => $countDay)
            {
                foreach($countDay as $kcd => $cd)
                {
                    if($product->getProductId() == $cd['product_id'])
                    {
                        $productName[$pkey] = $cd['product_name'];
                        $farmerProductPerDay[$pkey][$kday][$kcd] =  $cd['count'];
                    }
                }
            }
        }
        foreach($farmerProductPerDay as $key => $farmer)
        {
            $simplify[$key] = array_reduce($farmer, 'array_merge', array());
        }
        foreach($simplify as $key => $single)
        {
            $datasets[$key] = [
                'label' => $productName[$key],
                'backgroundColor' => $this->getColor()[$key],
                'borderColor' => $this->getColor()[$key],
                'data' => $single,
            ];
        }
        $data = [
            'labels' => $days,
            'datasets' => $datasets,
        ];
        return $data;

    }
    private function getChartInventoryUpdateData($inventoryDate,$farmerProducts,$startDate,$endDate)
    {
        $period = new DatePeriod($startDate,new DateInterval('P1D'),$endDate);
        foreach ($period as $key => $value) 
        {
            $days[$key] = $value->format('Y-m-d');
        }
        foreach($days as $kday => $day)
        {
            foreach($inventoryDate as $ikey => $inventory)
            {
                $i = 0;
                foreach($inventory['inventory_date'] as $dates)
                {
                    if($dates == $day)
                    {
                        $i++;
                    }
                }
                $count[$kday][$ikey]['count'] = $i;
                $count[$kday][$ikey]['product_id'] = $inventoryDate[$ikey]['product_id'][0];
                $count[$kday][$ikey]['product_name'] = $inventoryDate[$ikey]['product_name'][0];
                $count[$kday][$ikey]['inventory_id'] = $inventoryDate[$ikey]['inventory_id'][0];
                $count[$kday][$ikey]['inventory_date'] = $inventoryDate[$ikey]['inventory_date'][0];
            }      
        }
        foreach($farmerProducts as $pkey => $product)
        {
            foreach($count as $kday => $countDay)
            {
                foreach($countDay as $kcd => $cd)
                {
                    if($product->getProductId() == $cd['product_id'])
                    {
                        $productName[$pkey] = $cd['product_name'];
                        $farmerProductPerDay[$pkey][$kday][$kcd] =  $cd['count'];
                    }
                    
                }
            }
        }
        //die();
        //dump($farmerProductPerDay);die();
        foreach($farmerProductPerDay as $key => $farmer)
        {
            $simplify[$key] = array_reduce($farmer, 'array_merge', array());
        }
        //dump($simplify);die();
        foreach($simplify as $key => $single)
        {
            $datasets[$key] = [
                'label' => $productName[$key],
                'backgroundColor' => $this->getColor()[$key],
                'borderColor' => $this->getColor()[$key],
                'data' => $single,
            ];
        }
        //dump($datasets);die();
        $data = [
            'labels' => $days,
            'datasets' => $datasets,
        ];
        return $data;
    }
    private function getColor()
    {
        $color = [
            'rgb(255, 0, 0)',
            'rgb(0, 255, 0)',
            'rgb(0, 0, 255)',
            'rgb(255, 255, 0)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
            'rgb(255, 99, 132)',
        ];
        return $color;
    }
    private function getMayaniB2cRequestsPerProduct($mayaniArray, $farmerProducts)
    {
       foreach($farmerProducts as $key => $product)
       {
            $i = 0;
            foreach($mayaniArray as $mayani)
            {
                if($product->getInventoryId() == $mayani->getMProductInventoryId())
                {
                    $mayaniRequestDate = $mayani->getB2cProductRequestDate();
                    $mayaniRequestDateArray[$key]['b2c_product_request_date'][$i] = $mayaniRequestDate->format('Y-m-d');
                    $mayaniRequestDateArray[$key]['product_name'][$i] = $product->getProductName();
                    $mayaniRequestDateArray[$key]['product_id'][$i] = $product->getProductId();
                    $mayaniRequestDateArray[$key]['inventory_id'][$i++] = $mayani->getMProductInventoryId();
                }
            }
       }
       //die();
       return $mayaniRequestDateArray; 
    }
    private function getFarmerInventoryDatesPerProduct($inventoryArray, $farmerProducts)
    {
        
        foreach($farmerProducts as $key => $product)
        {
            $i = 0;
            foreach($inventoryArray as $inventory)
            {
                if($product->getInventoryId() == $inventory->getInventoryId())
                {
                    $inventoryDate = $inventory->getDate();
                    $inventoryDateArray[$key]['inventory_date'][$i] = $inventoryDate->format('Y-m-d');
                    $inventoryDateArray[$key]['product_name'][$i] = $product->getProductName();
                    $inventoryDateArray[$key]['product_id'][$i] = $product->getProductId();
                    $inventoryDateArray[$key]['inventory_id'][$i++] = $inventory->getInventoryId();
                }
            }
        }
        //dump($inventoryArray);dump($farmerProducts); dump($inventoryDateArray);die();

        return $inventoryDateArray; 
    }
    
    private function getFarmerInventoryUpdate(DocumentManager $dm,$farmerId, $startTime, $endTime)
    {
        $farmerInventory = $dm->createQueryBuilder(FarmerInventoryUpdate::class)
            ->field('farmerId')->equals($farmerId)
            ->field('date')->range($startTime,$endTime)
            ->sort('inventoryId','ASC')
            ->getQuery()       
            ->execute();
        $farmer = $farmerInventory->toArray();
        return $farmer;
    }
    private function getMayaniRequestData(DocumentManager $dm,$farmerId,$startTime,$endTime)
    {
        $mayaniData = $dm->createQueryBuilder(MayaniInventory::class)
            ->field('farmerBalanceId')->equals($farmerId)
            ->field('b2cProductRequestDate')->range($startTime,$endTime)
            ->sort('mProductInventoryId','ASC')    
            ->getQuery()
            ->execute();
        $mayani = $mayaniData->toArray();
        return $mayani;
    }
    private function setChartOptions($chart, $min = 0, $max = 2)
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
    private function setChartData(Chart $chart,$data)
    {
        $chart->setData($data);

        return $chart;
    }
    private function setPieChartData(Chart $chart,$data = null, $reportName)
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
                $data[$i] = $d['quantity_kg'];
                $backC[$i] = $this->getColor()[$key];
                $borderC[$i] = $this->getColor()[$key];
                $i++;
            }
        }
        $datasets =  [
            'label' => $reportName,
            'backgroundColor' => $backC,
            'borderColor' => $borderC,
            'data' => $data,
        ];
        $chart->setData([
            'labels' => $labels,
            'datasets' => ['0'=>$datasets]
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