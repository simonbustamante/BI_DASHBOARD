<?php

namespace App\Controller\Importer;

use App\Document\MayaniInventory;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MayaniInventoryImporterController extends AbstractController
{
    #[Route('/mayani-inventory', name: 'mayani-inventory')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerFarm::class)
            ->find()
            ;

        return $this->json([
            'farmer_farm' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-mayani-inventory', name: 'imiimi', methods: ['POST'])]
    public function importFarmerFarm(Request $request, DocumentManager $documentManager): Response
    {
        
        $content = file_get_contents($request->files->get('csv'));
        $rows = explode("\n", $content);
        $count = 0;
        $total = 0;
        foreach($rows as $singleField)
        {
            $fields = explode(",", $singleField);
            //dump($fields);die();
            if($fields[0] != "mProductInventoryId" && $fields[0]!="")
            {
                //dump($fields);die(); 
                $mayani = new MayaniInventory();
                $mayani->setMProductInventoryId($fields[0]);
                $mayani->setMProductInventoryDescription($fields[1]);
                $mayani->setMProductInventoryTotalKg($fields[2]);
                $mayani->setMProductInventoryTotalValue($fields[3]);
                $mayani->setMRequestInventoryId($fields[4]);
                $mayani->setMRequestInventoryKg($fields[5]);
                $mayani->setMRequestInventoryDebt($fields[6]);
                $mayani->setMRequestInventoryDate($fields[7]);
                $mayani->setMRequestInventoryDescription($fields[8]);
                $mayani->setFarmInventoryId($fields[9]);
                $mayani->setB2cProductRequestId($fields[10]);
                $mayani->setB2cProductRequestDescription($fields[11]);
                $mayani->setB2cProductRequestKg($fields[12]);
                $mayani->setB2cProductRequestTotalDebt($fields[13]);
                $mayani->setB2cProductRequestDate($fields[14]);
                $mayani->setFarmerBalanceId($fields[15]);
                $documentManager->persist($mayani);
                $count++;
                if($count == '100000'){
                    $documentManager->flush();
                    $total = $total + $count;
                    $count = 0;

                }
            }
        }
        if($count != 0)
        {
            $total = $total + $count;
            $documentManager->flush();
        }

        return $this->json($total);
    }

}
