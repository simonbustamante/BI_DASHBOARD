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
                $farmer->setInventory_id($fields[1]);
                $farmer->setProduct_id($fields[2]);
                $farmer->setInventory_date($fields[3]);
                $farmer->setInventory_total_credit($fields[4]);
                $farmer->setInventory_total_kg($fields[5]);
                $farmer->setInventory_description($fields[6]);
                $farmer->setProduct_name($fields[7]);
                $farmer->setPrice_per_kg($fields[8]);
                $farmer->setKg_per_month($fields[9]);
                $farmer->setActivity_id($fields[10]);
                $farmer->setActivity_name($fields[11]);
                $farmer->setActivity_description($fields[12]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
