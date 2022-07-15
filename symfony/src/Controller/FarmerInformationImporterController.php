<?php

namespace App\Controller;

use App\Document\FarmerInformation;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerInformationImporterController extends AbstractController
{
    #[Route('/farmer-information', name: 'farmer-information')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerInformation::class)
            ->find()
            ;

        return $this->json([
            'farmer_information' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-information', name: 'ifi', methods: ['POST'])]
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
                $farmer = new FarmerInformation();
                $farmer->setFarmerId($fields[0]);
                $farmer->setName($fields[1]);
                $farmer->setMiddle($fields[2]);
                $farmer->setSurname($fields[3]);
                $farmer->setSex($fields[4]);
                $farmer->setAddress($fields[5]);
                $farmer->setContact($fields[6]);
                $farmer->setBirthday($fields[7]);
                $farmer->setBirthplace($fields[8]);
                $farmer->setBirthcontry($fields[9]);
                $farmer->setReligion($fields[10]);
                $farmer->setCivilstatus($fields[11]);
                $farmer->setSpouse($fields[12]);
                $farmer->setEducation($fields[13]);
                $farmer->setGovernmentid($fields[14]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
