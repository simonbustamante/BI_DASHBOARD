<?php

namespace App\Controller;

use App\Document\FarmerLoanPayment;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerLoanPaymentImporterController extends AbstractController
{
    #[Route('/farmer-loan-details', name: 'farmer-loan-details')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerLoanPayment::class)
            ->find()
            ;

        return $this->json([
            'farmer_loan_payment' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-loan-payment', name: 'iflp', methods: ['POST'])]
    public function importFarmerLoanPayment(Request $request, DocumentManager $documentManager): Response
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
                $farmer = new FarmerLoanPayment();
                $farmer->setFarmerId($fields[0]);
                $farmer->setLoan_payment_id($fields[1]);
                $farmer->setFarmer_balance_id($fields[2]);
                $farmer->setLoan_id($fields[3]);
                $farmer->setLoan_date($fields[4]);
                $farmer->setLoan_quantity_paid($fields[5]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
