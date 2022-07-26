<?php

namespace App\Controller\Importer;

use App\Document\FarmerBalance;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerBalanceImporterController extends AbstractController
{
    #[Route('/farmer-balance', name: 'farmer-balance')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerBalance::class)
            ->find()
            ;

        return $this->json([
            'farmer_balance' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-balance', name: 'ifb', methods: ['POST'])]
    public function importFarmerBalance(Request $request, DocumentManager $documentManager): Response
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
                $farmerBalance = new FarmerBalance();
                $farmerBalance->setFarmerId($fields[0]);
                $farmerBalance->setBalanceId($fields[1]);
                $farmerBalance->setDebt($fields[2]);
                $farmerBalance->setCredit($fields[3]);
                $farmerBalance->setMonthlyFee($fields[4]);
                $farmerBalance->setFarmerDescription($fields[5]);
                $documentManager->persist($farmerBalance);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
