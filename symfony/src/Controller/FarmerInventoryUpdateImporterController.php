<?php

namespace App\Controller;

use App\Document\FarmerInventoryUpdate;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerInventoryUpdateImporterController extends AbstractController
{
    #[Route('/farmer-inventory-update', name: 'farmer-inventory-update')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerInventoryUpdate::class)
            ->find()
            ;

        return $this->json([
            'farmer_inventory_update' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-inventory-update', name: 'ifiu', methods: ['POST'])]
    public function importFarmerInvUpd(Request $request, DocumentManager $documentManager): Response
    {
        //dump(file_get_contents($request->files->get('csv')));die();
        $content = file_get_contents($request->files->get('csv'));
        $rows = explode("\n", $content);
        $count = 0;
        foreach($rows as $singleField)
        {
            $fields = explode(",", $singleField);
            if($fields[0] != "farmer_id" && $fields[0]!="")
            {
                $farmer = new FarmerInventoryUpdate();
                $farmer->setFarmerId($fields[0]);
                $farmer->setInventoryUpdateId($fields[1]);
                $farmer->setInventoryId($fields[2]);
                $farmer->setQuantityKg($fields[3]);
                $farmer->setCredit($fields[4]);
                $farmer->setDate($fields[5]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();
        

        return $this->json($count);
    }

}
