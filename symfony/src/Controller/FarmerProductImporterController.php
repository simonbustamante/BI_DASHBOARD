<?php

namespace App\Controller;

use App\Document\FarmerProduct;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerProductImporterController extends AbstractController
{
    #[Route('/farmer-product', name: 'farmer-product')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerProduct::class)
            ->find()
            ;

        return $this->json([
            'farmer_product' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-product', name: 'ifppp', methods: ['POST'])]
    public function importFarmerGroup(Request $request, DocumentManager $documentManager): Response
    {
        
        $content = file_get_contents($request->files->get('csv'));
        $rows = explode("\n", $content);
        $count = 0;
        foreach($rows as $singleField)
        {
            $fields = explode(",", $singleField);
            //dump($fields);die();
            if($fields[0] != "farmer_id" && $fields[0]!="")
            {
                //dump($fields);die(); 
                $farmer = new FarmerProduct();
                $farmer->setFarmerId($fields[0]);
                $farmer->setInventoryId($fields[1]);
                $farmer->setProductId($fields[2]);
                $farmer->setInventoryDate($fields[3]);
                $farmer->setInventoryTotalCredit($fields[4]);
                $farmer->setInventoryTotalKg($fields[5]);
                $farmer->setInventoryDescription($fields[6]);
                $farmer->setProductName($fields[7]);
                $farmer->setPricePerKg($fields[8]);
                $farmer->setKgPerMonth($fields[9]);
                $farmer->setActivityId($fields[10]);
                $farmer->setActivityName($fields[11]);
                $farmer->setActivityDescription($fields[12]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
