<?php

namespace App\Controller;

use App\Document\FarmerSellDetail;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FarmerSellDetailImporterController extends AbstractController
{
    #[Route('/farmer-sell-detail', name: 'farmer-sell-detail')]
    public function index(DocumentManager $documentManager): Response
    {
        $cursor = $documentManager
            ->getDocumentCollection(FarmerSellDetail::class)
            ->find()
            ;

        return $this->json([
            'farmer_sell_detail' => $cursor->toArray(),
        ]);
    }


    #[Route('/import-farmer-sell-detail', name: 'ifsd', methods: ['POST'])]
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
                $farmer = new FarmerSellDetail();
                $farmer->setFarmerId($fields[0]);
                $farmer->setIdOrder($fields[1]);
                $farmer->setOrder_reference($fields[2]);
                $farmer->setProductId($fields[3]);
                $farmer->setProductName($fields[4]);
                $farmer->setProductQuantity($fields[5]);
                $farmer->setProductPrice($fields[6]);
                $farmer->setProduct_quantity_in_stock($fields[7]);
                $farmer->setProduct_quantity_refunded($fields[8]);
                $farmer->setProduct_quantity_return($fields[9]);
                $farmer->setProduct_quantity_reinjected($fields[10]);
                $farmer->setProduct_quantity_discount($fields[11]);
                $farmer->setProduct_attribute_id($fields[12]);
                $farmer->setProduct_ean13($fields[13]);
                $farmer->setProduct_isbn($fields[14]);
                $farmer->setProduct_upc($fields[15]);
                $farmer->setProduct_mpn($fields[16]);
                $farmer->setProduct_reference($fields[17]);
                $farmer->setProduct_supplier_reference($fields[18]);
                $farmer->setProductWeight($fields[19]);
                $farmer->setTotal_discounts($fields[20]);
                $farmer->setTotal_discounts_tax_incl($fields[21]);
                $farmer->setTotal_discounts_tax_excl($fields[22]);
                $farmer->setTotal_paid($fields[23]);
                $farmer->setTotal_paid_tax_incl($fields[24]);
                $farmer->setTotal_paid_tax_excl($fields[25]);
                $farmer->setTotal_paid_real($fields[26]);
                $farmer->setTotal_products($fields[27]);
                $farmer->setTotal_products_wt($fields[28]);
                $farmer->setTotal_shipping($fields[29]);
                $farmer->setTotal_price_tax_incl($fields[30]);
                $farmer->setTotal_price_tax_excl($fields[31]);
                $farmer->setTotal_refunded_tax_excl($fields[32]);
                $farmer->setTotal_refunded_tax_incl($fields[33]);
                $farmer->setTotal_shipping_price_tax_incl($fields[34]);
                $farmer->setTotal_shipping_price_tax_excl($fields[35]);
                $farmer->setShipping_cost_tax_excl($fields[36]);
                $farmer->setShipping_cost_tax_incl($fields[37]);
                $farmer->setId_customization($fields[38]);
                $farmer->setReduction_percent($fields[39]);
                $farmer->setReduction_amount($fields[40]);
                $farmer->setReduction_amount_tax_incl($fields[41]);
                $farmer->setReduction_amount_tax_excl($fields[42]);
                $farmer->setGroup_reduction($fields[43]);
                $farmer->setId_shop_group($fields[44]);
                $farmer->setId_shop($fields[45]);
                $farmer->setId_carrier($fields[46]);
                $farmer->setId_lang($fields[47]);
                $farmer->setId_customer($fields[48]);
                $farmer->setId_cart($fields[49]);
                $farmer->setId_currency($fields[50]);
                $farmer->setD_address_delivery($fields[51]);
                $farmer->setId_address_invoice($fields[52]);
                $farmer->setCurrent_state($fields[53]);
                $farmer->setPayment($fields[54]);
                $farmer->setConversion_rate($fields[55]);
                $farmer->setModule($fields[56]);
                $farmer->setRecyclable($fields[57]);
                $farmer->setGift($fields[58]);
                $farmer->setGift_message($fields[59]);
                $farmer->setMobile_theme($fields[60]);
                $farmer->setShipping_number($fields[61]);
                $farmer->setCarrier_tax_rate($fields[62]);
                $farmer->setTotal_wrapping($fields[63]);
                $farmer->setTotal_wrapping_tax_incl($fields[64]);
                $farmer->setTotal_wrapping_tax_excl($fields[65]);
                $farmer->setRound_mode($fields[66]);
                $farmer->setRound_type($fields[67]);
                $farmer->setInvoice_number($fields[68]);
                $farmer->setDelivery_number($fields[69]);
                $farmer->setInvoiceDate($fields[70]);
                $farmer->setDelivery_date($fields[71]);
                $farmer->setValid($fields[72]);
                $farmer->setDate_add($fields[73]);
                $farmer->setDate_upd($fields[74]);
                $farmer->setNote($fields[75]);
                $farmer->setId_order_detail($fields[76]);
                $farmer->setId_warehouse($fields[77]);
                $farmer->setId_tax_rules_group($fields[78]);
                $farmer->setTax_computation_method($fields[79]);
                $farmer->setTax_name($fields[80]);
                $farmer->setTax_rate($fields[81]);
                $farmer->setEcotax($fields[82]);
                $farmer->setEcotax_tax_rate($fields[83]);
                $farmer->setDiscount_quantity_applied($fields[84]);
                $farmer->setDownload_hash($fields[85]);
                $farmer->setDownload_nb($fields[86]);
                $farmer->setDownload_deadline($fields[87]);
                $farmer->setUnit_price_tax_incl($fields[88]);
                $farmer->setUnit_price_tax_excl($fields[89]);
                $farmer->setPurchase_supplier_price($fields[90]);
                $farmer->setOriginal_product_price($fields[91]);
                $farmer->setOriginal_wholesale_price($fields[92]);
                $farmer->setId_order_carrier($fields[93]);
                $farmer->setWeight($fields[94]);
                $farmer->setTracking_number($fields[95]);
                $documentManager->persist($farmer);
                $count++;
            }
        }
        $documentManager->flush();

        return $this->json($count);
    }

}
