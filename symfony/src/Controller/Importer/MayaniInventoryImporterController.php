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
            if($fields[0] != "farmerId" && $fields[0]!="")
            {
                //dump($fields);die(); 
                $mayani = new MayaniInventory();
                $mayani->setFarmerId($fields[0]);
                $mayani->setFarmerBalanceId($fields[1]);
                $mayani->setB2cProductRequestId($fields[2]);
                $mayani->setB2cProductRequestDescription($fields[3]);
                $mayani->setB2cProductRequestKg($fields[4]);
                $mayani->setB2cProductRequestTotalDebt($fields[5]);
                $mayani->setB2cProductRequestDate($fields[6]);
                $mayani->setFarmInventoryId($fields[7]);
                $documentManager->persist($mayani);
                $count++;
                if($count == '50000'){
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
