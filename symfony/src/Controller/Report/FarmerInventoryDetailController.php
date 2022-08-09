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
                        //dump($inventoryArray);die();
                    if(empty($inventoryArray))
                    {
                        $this->addFlash('warning','Please select other dates since there is no data related to these dates');
                        return $this->redirectToRoute('farmer_inventory');
                    }
                    $mayaniArray = $this->getMayaniRequestData($dm,$farmerId,$startDate,$endDate);
                        //dump($mayaniArray);die();
                    $farmerProducts = $this->getFarmerProduct($dm, $farmerId);
                    
                    //the initial  nor the last
                    $realInventory = $this->getFarmerinventory($dm, $farmerId);
                        //dump($realInventory);//die();

                    //first chart and piechart
                    $chart = $this->setChartType($chartBuilder,"TYPE_LINE");
                    $pieChart = $this->setChartType($chartBuilder,"TYPE_PIE");
                    $inventoryDate = $this->getFarmerInventoryDatesPerProduct($inventoryArray, $farmerProducts);
                        //dump($inventoryDate);die();
                    $data = $this->getChartInventoryUpdateData($inventoryDate,$farmerProducts,$startDate,$endDate);
                    $farmerInventoryUpdateQuantity = $this->getFarmerProductInventoryUpdate($inventoryArray,$farmerProducts);
                    
                    //second chart and pie chart
                    $chart2 = $this->setChartType($chartBuilder,"TYPE_LINE");
                    $pieChart2 = $this->setChartType($chartBuilder,"TYPE_PIE");
                    $b2cRequests = $this->getMayaniB2cRequestsPerProduct($mayaniArray, $farmerProducts);
                    //dump($b2cRequests);die();
                    $data2 = $this->getChartMayaniB2cRequestData($b2cRequests,$farmerProducts,$startDate,$endDate);
                    $b2cInventoryRequestQuantity = $this->getB2cInventoryRequest($mayaniArray, $farmerProducts);
                    
                    //third chart
                    $chart3 = $this->setChartType($chartBuilder,"TYPE_LINE");
                    $totalInventoryOverTime = $this->getInventoryAndB2cPerProduct($inventoryDate,$b2cRequests,$farmerProducts);
                    $data3 = $this->getChartInventoryLessB2cData($totalInventoryOverTime,$realInventory,$farmerProducts,$startDate,$endDate);
                    
                    //tables
                    $dataTable = $this->generateDataTable($inventoryArray,$request);
                    $b2cTable = $this->generateDataTable($mayaniArray,$request);
                    $farmerProductTable = $this->generateDataTable($realInventory,$request);
                    //dump($b2cTable);dump($farmerProductTable);die();

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
            $pieChart2 = $this->setPieChartData($pieChart2,$b2cInventoryRequestQuantity,'Quantity of inventory requested by Mayani');
            $chart3 = $this->setChartData($chart3, $data3['data']);
        }
        else{
            $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
            $chart2 = $chartBuilder->createChart(Chart::TYPE_BAR);
            $chart3 = $chartBuilder->createChart(Chart::TYPE_BAR);
            $pieChart = $chartBuilder->createChart(Chart::TYPE_PIE);
            $pieChart2 = $chartBuilder->createChart(Chart::TYPE_PIE);
            //$chart = $chart->setData($this->dummyData());
            $chart = $this->setChartData($chart,[]);
            $chart2 = $this->setChartData($chart2,[]);
            $chart3 = $this->setChartData($chart3,[]);
            $pieChart = $this->setPieChartData($pieChart,null,'Quantity of inventory updated over time');
            $pieChart2 = $this->setPieChartData($pieChart2,null,'Quantity of inventory requested by Mayani');

            $realInventory = [];

            $dataTable = $this->generateDataTable([],$request);
            $b2cTable = $this->generateDataTable([],$request);
            $farmerProductTable = $this->generateDataTable([],$request);
            $startDate = "";
            $endDate = "";
            $farmerId = "all";
            
        }
        $chart = $this->setChartOptions($chart);
        $chart2 = $this->setChartOptions($chart2);
        $chart3 = $this->setChartOptions($chart3);
        $pieChart = $this->setChartOptions($pieChart);
        $pieChart2 = $this->setChartOptions($pieChart2);
        return $this->render('inventory/farmer-inventory.html.twig', [
            'form' => $form->createView(),
            'farmerId' => $farmerId,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'inventory_time_line' => $chart,
            'b2c_time_line' => $chart2,
            'real_inventory_time_line' => $chart3,
            'inventory_quantity' => $pieChart,
            'quantity_on_mayani' => $pieChart2,
            'real_inventory' => $realInventory,
            'data_table' => $dataTable,
            'b2c_table' => $b2cTable,
            'farmer_product_table' => $farmerProductTable,
        ]);
    }
    #[Route('/inventory/inv_exp-csv/{farmerId}/{startDate}/{endDate}', name: 'inv_exp_csv')]
    public function exportInvCsv($farmerId,$startDate,$endDate, DocumentManager $dm)
    {
        $rowsInv = array();
        if($farmerId != "none")
        {
            $inventoryArray = $this->getFarmerInventoryUpdate($dm,$farmerId,$startDate,$endDate);
            foreach($inventoryArray as $inventory)
            {
                $inventoryData = array(
                    $inventory->getFarmerId(),
                    $inventory->getInventoryUpdateId(),
                    $inventory->getInventoryId(),
                    $inventory->getQuantityKg(),
                    "$".$inventory->getCredit(),
                    $inventory->getDate()->format('Y-m-d'),
                );
                $rowsInv[] = implode(',', $inventoryData);
            }
        }
        $content = implode("\n", $rowsInv);
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');
        return $response;
    }
    #[Route('/inventory/b2c_exp-csv/{farmerId}/{startDate}/{endDate}', name: 'b2c_exp_csv')]
    public function exportB2cCsv($farmerId,$startDate,$endDate, DocumentManager $dm)
    {
        //dump($farmerId);
        //$rows = array();
        //$rowsInv = array();
        $rowsMay = array();
        //$rowsReal = array();

        if($farmerId != "none")
        {
            $mayaniArray = $this->getMayaniRequestData($dm,$farmerId,$startDate,$endDate);
            foreach($mayaniArray as $mayani)
            {
                $mayaniData = array(
                    $mayani->getFarmerId(),
                    $mayani->getFarmerBalanceId(),
                    $mayani->getB2cProductRequestId(),
                    $mayani->getB2cProductRequestDescription(),
                    $mayani->getB2cProductRequestKg(),
                    $mayani->getB2cProductRequestTotalDebt(),
                    $mayani->getB2cProductRequestDate()->format('Y-m-d'),
                    $mayani->getFarmInventoryId(),
                );
                $rowsMay[] = implode(',', $mayaniData);
            }
        }
        $content = implode("\n", $rowsMay);
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');

        return $response;
    }
    #[Route('/inventory/fp_exp-csv/{farmerId}/{startDate}/{endDate}', name: 'fp_exp_csv')]
    public function exportFarmerProductCsv($farmerId,$startDate,$endDate, DocumentManager $dm)
    {
        $rowsReal = array();
        if($farmerId != "none")
        {
            $realInventory = $this->getFarmerinventory($dm, $farmerId);
            foreach($realInventory as $real)
            {
                $realData = array(
                    $real->getFarmerId(),
                    $real->getinventoryId(),
                    $real->getProductId(),
                    $real->getInventoryDate(),
                    $real->getInventoryTotalCredit(),
                    $real->getInventoryTotalKg(),
                    $real->getInventoryDescription(),
                    $real->getProductName(),
                    $real->getPricePerKg(),
                    $real->getKgPerMonth(),
                    $real->getActivityId(),
                    $real->getActivityName(),
                    $real->getActivityDescription(),
                );
                $rowsReal[] = implode(',', $realData);
            }
        }
        $content = implode("\n", $rowsReal);
        $response = new Response($content);
        $response->headers->set('Content-Type', 'text/csv');

        return $response;
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
    private function getB2cInventoryRequest($mayaniArray, $farmerProducts)
    {
        //$i = 0;
        foreach($farmerProducts as $pkey => $product)
        {
            $i = 0;
            foreach($mayaniArray as $inventory)
            {   
                if($product->getInventoryId() == $inventory->getFarmInventoryId())
                {
                    $all[$pkey]['product_name'][$i] = $product->getProductName();
                    $all[$pkey]['product_id'][$i] = $product->getProductId(); 
                    $all[$pkey]['quantity_kg'][$i++] = $inventory->getB2cProductRequestKg(); 
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
    private function getChartInventoryLessB2cData($totalInventoryOverTime,$realInventory,$farmerProducts,$startDate,$endDate)
    {
        $period = new DatePeriod($startDate,new DateInterval('P1D'),$endDate);
        foreach ($period as $key => $value) 
        {
            $days[$key] = $value->format('Y-m-d');
        }
        //dump($totalInventoryOverTime);die();
        $count = [];
        $j = [];
        foreach ($days as $kday => $day)
        {
            foreach($totalInventoryOverTime as $tiotKey => $tiot)
            {   
                //dump($totalInventoryOverTime);die();
                //dump($realInventory[$tiotKey]->getInventoryTotalKg());die();
                //$i = 0;
                $i = $realInventory[$tiotKey]->getInventoryTotalKg();
                //$x = 0;
                foreach($tiot['b2c_and_iupdate'] as $dkey => $dates)
                {   
                    if($dates == $day)
                    {
                        //dump($dates);
                        //dump($x);
                        //dump($tiot['quantity_kg'][$dkey]);
                        // if($tiot['quantity_kg'][$dkey] > 0 || $tiot['quantity_kg'][$dkey] < 0)
                        $i = $i + $tiot['quantity_kg'][$dkey];
                        // {
                        if(isset($j[$tiotKey]))
                        {
                            $j[$tiotKey] = $j[$tiotKey] + $tiot['quantity_kg'][$dkey];
                        }
                        else
                        {
                            $j[$tiotKey] = $i;
                        }
                        //}
                        //$i = $i + $j[$tiotKey];
                        //dump($i);
                        //dump($j[$tiotKey]);
                        //dump("-------------YYY--------------");
                        // if($tiot['quantity_kg'][$dkey]=="-15")
                        // {
                        //     die();
                        // }
                        
                    }
                    else
                    {
                        //dump($dates);
                        if(!isset($j[$tiotKey]))
                        {
                            $j[$tiotKey] = $i;
                        }
                        // else
                        // {
                        //     $j[$tiotKey] = $j[$tiotKey] + $i;
                        // }
                        //$x++;
                        //dump($i);
                        //dump($j[$tiotKey]);
                        //dump("-------------zzz--------------");    
                    }
                }
                $lastValue[$tiotKey] = $j[$tiotKey];
                $count[$kday][$tiotKey]['count'] = $j[$tiotKey];
                
                
                
                $count[$kday][$tiotKey]['product_id'] = $totalInventoryOverTime[$tiotKey]['product_id'][$dkey];
                $count[$kday][$tiotKey]['product_name'] = $totalInventoryOverTime[$tiotKey]['product_name'][$dkey];
                $count[$kday][$tiotKey]['inventory_id'] = $totalInventoryOverTime[$tiotKey]['inventory_id'][$dkey];
                $count[$kday][$tiotKey]['b2c_and_iupdate'] = $totalInventoryOverTime[$tiotKey]['b2c_and_iupdate'][$dkey];
            }
        }
        //dump($count);die();
        foreach($farmerProducts as $pkey => $product)
        {
            foreach($count as $kday => $countDay)
            {   
                //dump($count[$kday]['b2c_and_iupdate']);die();
                foreach($countDay as $kcd => $cd)
                {
                    
                    if($product->getProductId() == $cd['product_id'])
                    {
                        $productName[$pkey] = $cd['product_name'];
                        //dump($cd);
                        $farmerProductPerDay[$pkey][$kday][$kcd] =  $cd['count'];
                    }
                }
            }
        }
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
        $data = [
            'labels' => $days,
            'datasets' => $datasets,
        ];
        //dump($lastValue);die();
        return [
            'data' => $data,
            'lastValue' => $lastValue
        ];
    }
    private function getChartMayaniB2cRequestData($b2cRequests,$farmerProducts,$startDate,$endDate)
    {
        $period = new DatePeriod($startDate,new DateInterval('P1D'),$endDate);
        foreach ($period as $key => $value) 
        {
            $days[$key] = $value->format('Y-m-d');
        }
        //dump($b2cRequests);die();
        foreach ($days as $kday => $day)
        {
            foreach($b2cRequests as $ikey => $b2cR)
            {
                $i = 0;
                foreach($b2cR['b2c_product_request_date'] as $kd => $dates)
                {
                    if($dates == $day)
                    {
                        $i++;
                    }
                }
                $count[$kday][$ikey]['count'] = $i;
                $count[$kday][$ikey]['product_id'] = $b2cRequests[$ikey]['product_id'][$kd];
                $count[$kday][$ikey]['product_name'] = $b2cRequests[$ikey]['product_name'][$kd];
                $count[$kday][$ikey]['inventory_id'] = $b2cRequests[$ikey]['inventory_id'][$kd];
                $count[$kday][$ikey]['b2c_product_request_date'] = $b2cRequests[$ikey]['b2c_product_request_date'][$kd];
            }
        }
        //dump($count);die(); 
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
    private function getInventoryAndB2cPerProduct($inventoryDate,$b2cRequests,$farmerProducts)
    {
        
        foreach($farmerProducts as $key => $product)
        {
            $totalKg = 0;
            foreach($inventoryDate as $ikey => $inventory)
            {
                foreach($inventory['inventory_id'] as $iidkey => $iid)
                {
                    if($product->getInventoryId() == $iid)
                    {
    
                        $b2cAndIupdateArray[$key]['b2c_and_iupdate'][$iidkey] = $inventoryDate[$key]['inventory_date'][$iidkey];
                        $b2cAndIupdateArray[$key]['product_name'][$iidkey] = $product->getProductName();
                        $b2cAndIupdateArray[$key]['product_id'][$iidkey] = $product->getProductId();
                        $b2cAndIupdateArray[$key]['inventory_id'][$iidkey] = $inventoryDate[$key]['inventory_id'][$iidkey];
                        $b2cAndIupdateArray[$key]['quantity_kg'][$iidkey] = $inventoryDate[$key]['quantity_kg'][$iidkey];
                        // if(isset($totalKg))
                        // {
                        //     $totalKg = $totalKg + $inventoryDate[$key]['quantity_kg'][$iidkey];
                        // }
                        // else
                        // {
                        //     $totalKg = $inventoryDate[$key]['quantity_kg'][$iidkey];
                        // }
                        // $b2cAndIupdateArray[$key]['total_kg'][$iidkey] = $totalKg;        
                    }
                    $i = $iidkey + 1;
                }
            }
                //dump($b2cAndIupdateArray);die();
            foreach($b2cRequests as $rkey =>$request)
            {
                //dump($b2cRequests);die();
                foreach($request['inventory_id'] as $ridkey => $rid)
                {
                    if($product->getInventoryId() == $rid)
                    {
                        $b2cAndIupdateArray[$key]['b2c_and_iupdate'][$i] = $b2cRequests[$key]['b2c_product_request_date'][$ridkey];
                        $b2cAndIupdateArray[$key]['product_name'][$i] = $product->getProductName();
                        $b2cAndIupdateArray[$key]['product_id'][$i] = $product->getProductId();
                        $b2cAndIupdateArray[$key]['inventory_id'][$i] = $b2cRequests[$key]['inventory_id'][$ridkey];
                        $b2cAndIupdateArray[$key]['quantity_kg'][$i] = ($b2cRequests[$key]['quantity_kg'][$ridkey] * -1);
                        // if(isset($totalKg))
                        // {
                        //     $totalKg = $totalKg - $b2cRequests[$key]['quantity_kg'][$ridkey];
                        // }
                        // else
                        // {
                        //     $totalKg = $b2cRequests[$key]['quantity_kg'][$ridkey];
                        // }
                        // $b2cAndIupdateArray[$key]['total_kg'][$i] = $totalKg; 
                        $i++;
                    }
                }
            }
        }
        
        return $b2cAndIupdateArray;
    }
    private function getMayaniB2cRequestsPerProduct($mayaniArray, $farmerProducts)
    {
       foreach($farmerProducts as $key => $product)
       {
            $i = 0;
            foreach($mayaniArray as $mayani)
            {
                if($product->getInventoryId() == $mayani->getFarmInventoryId())
                {
                    $mayaniRequestDate = $mayani->getB2cProductRequestDate();
                    $mayaniRequestDateArray[$key]['b2c_product_request_date'][$i] = $mayaniRequestDate->format('Y-m-d');
                    $mayaniRequestDateArray[$key]['product_name'][$i] = $product->getProductName();
                    $mayaniRequestDateArray[$key]['product_id'][$i] = $product->getProductId();
                    $mayaniRequestDateArray[$key]['inventory_id'][$i] = $mayani->getFarmInventoryId();
                    $mayaniRequestDateArray[$key]['quantity_kg'][$i++] = $mayani->getB2cProductRequestKg();
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
                    $inventoryDateArray[$key]['inventory_id'][$i] = $inventory->getInventoryId();
                    $inventoryDateArray[$key]['quantity_kg'][$i++] = $inventory->getQuantityKg();
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
    private function getFarmerinventory(DocumentManager $dm, $farmerId)
    {
        $farmerInventory = $dm->createQueryBuilder(FarmerProduct::class)
            ->field('farmerId')->equals($farmerId)
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
            ->sort('farmInventoryId','ASC')    
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