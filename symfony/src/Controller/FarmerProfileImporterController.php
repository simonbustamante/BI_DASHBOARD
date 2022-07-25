<?php

namespace App\Controller;

use App\Document\FarmerProfile;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerProfileImporterController extends AbstractController
{
    #[Route('/farmers', name: 'farmers')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerProfile::class)
            ->find()
            ;

        return $this->json([
            'farmers' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-profile', name: 'ifp', methods: ['POST'])]
    public function importFarmerProfile(Request $request, DocumentManager $documentManager): Response
    {
        
        $content = file_get_contents($request->files->get('csv'));
        $rows = explode("\n", $content);
        //dump($rows);die();
        $count = 0;
        foreach($rows as $value)
        {
            if($value != "farmer_id" && $value != "")
            {
                $farmerProfile = new FarmerProfile();
                $farmerProfile->setFarmerId($value);
                //dump($farmerProfile);die();
                $documentManager->persist($farmerProfile);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
