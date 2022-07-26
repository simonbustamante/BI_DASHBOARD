<?php

namespace App\Controller\Importer;

use App\Document\FarmerGroup;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerGroupImporterController extends AbstractController
{
    #[Route('/farmer-group', name: 'farmer-group')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerGroup::class)
            ->find()
            ;

        return $this->json([
            'farmer_group' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-group', name: 'ifg', methods: ['POST'])]
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
                $farmer = new FarmerGroup();
                $farmer->setFarmerId($fields[0]);
                $farmer->setGroups_id($fields[1]);
                $farmer->setGroups_name($fields[2]);
                $farmer->setGroups_idnumber($fields[3]);
                $farmer->setGroups_year($fields[4]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
