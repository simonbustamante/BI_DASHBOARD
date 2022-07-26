<?php

namespace App\Controller\Importer;

use App\Document\FarmerLoanDetails;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerLoanDetailsImporterController extends AbstractController
{
    #[Route('/farmer-loan-details', name: 'farmer-loan-details')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerLoanDetails::class)
            ->find()
            ;

        return $this->json([
            'farmer_loan_details' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-loan-details', name: 'ifld', methods: ['POST'])]
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
                $farmer = new FarmerLoanDetails();
                $farmer->setFarmerId($fields[0]);
                $farmer->setLoan_id($fields[1]);
                $farmer->setLoan_debt($fields[2]);
                $farmer->setTime_to_pay($fields[3]);
                $farmer->setMonthly_fee($fields[4]);
                $farmer->setDate_of_approval($fields[5]);
                $farmer->setLoan_status($fields[6]);
                $farmer->setLoan_description($fields[7]);
                $farmer->setLoan_type_id($fields[8]);
                $farmer->setLoan_type_name($fields[9]);
                $farmer->setLoan_type_description($fields[10]);
                $farmer->setLoan_interest($fields[11]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
