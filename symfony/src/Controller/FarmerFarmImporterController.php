<?php

namespace App\Controller;

use App\Document\FarmerFarm;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerFarmImporterController extends AbstractController
{
    #[Route('/farmer-farm', name: 'farmer-farm')]
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


    #[Route('/import-farmer-farm', name: 'iff', methods: ['POST'])]
    public function importFarmerFarm(Request $request, DocumentManager $documentManager): Response
    {
        
        $content = file_get_contents($request->files->get('csv'));
        $rows = explode("\n", $content);
        $count = 0;
        foreach($rows as $singleField)
        {
            $fields = explode(",", $singleField);
            //dump($fields);die();
            if($fields[0] != "farmer_id")
            {
                //dump($fields);die(); 
                $farmer = new FarmerFarm();
                $farmer->setFarmerId($fields[0]);
                $farmer->setFarmId($fields[1]);
                $farmer->setFarmName($fields[2]);
                $farmer->setFarmHouse($fields[3]);
                $farmer->setFarmStreet($fields[4]);
                $farmer->setFarmBarangay($fields[5]);
                $farmer->setFarmMunicipality($fields[6]);
                $farmer->setFarmProvince($fields[7]);
                $farmer->setFarmRegion($fields[8]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
