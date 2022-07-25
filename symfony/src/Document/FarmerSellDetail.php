<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_sell_details")]
class FarmerSellDetail
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;

    #[MongoDB\Field(type: Type::STRING)]
    private $idOrder;

    #[MongoDB\Field(type: Type::STRING)]
    private $order_reference;

    #[MongoDB\Field(type: Type::STRING)]
    private $productId;

    #[MongoDB\Field(type: Type::STRING)]
    private $productName;

    #[MongoDB\Field(type: Type::INT)]
    private $productQuantity;

    #[MongoDB\Field(type: Type::STRING)]
    private $productPrice;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_quantity_in_stock;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_quantity_refunded;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_quantity_return;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_quantity_reinjected;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_quantity_discount;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_attribute_id;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_ean13;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_isbn;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_upc;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_mpn;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_reference;

    #[MongoDB\Field(type: Type::STRING)]
    private $product_supplier_reference;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $productWeight;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_discounts;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_discounts_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_discounts_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_paid;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_paid_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_paid_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_paid_real;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_products;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_products_wt;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_shipping;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_price_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_price_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_refunded_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_refunded_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_shipping_price_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_shipping_price_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $shipping_cost_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $shipping_cost_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_customization;

    #[MongoDB\Field(type: Type::STRING)]
    private $reduction_percent;

    #[MongoDB\Field(type: Type::STRING)]
    private $reduction_amount;

    #[MongoDB\Field(type: Type::STRING)]
    private $reduction_amount_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $reduction_amount_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $group_reduction;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_shop_group;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_shop;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_carrier;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_lang;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_customer;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_cart;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_currency;

    #[MongoDB\Field(type: Type::STRING)]
    private $d_address_delivery;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_address_invoice;

    #[MongoDB\Field(type: Type::STRING)]
    private $current_state;

    #[MongoDB\Field(type: Type::STRING)]
    private $payment;

    #[MongoDB\Field(type: Type::STRING)]
    private $conversion_rate;

    #[MongoDB\Field(type: Type::STRING)]
    private $module;

    #[MongoDB\Field(type: Type::STRING)]
    private $recyclable;

    #[MongoDB\Field(type: Type::STRING)]
    private $gift;

    #[MongoDB\Field(type: Type::STRING)]
    private $gift_message;

    #[MongoDB\Field(type: Type::STRING)]
    private $mobile_theme;

    #[MongoDB\Field(type: Type::STRING)]
    private $shipping_number;

    #[MongoDB\Field(type: Type::STRING)]
    private $carrier_tax_rate;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_wrapping;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_wrapping_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $total_wrapping_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $round_mode;

    #[MongoDB\Field(type: Type::STRING)]
    private $round_type;

    #[MongoDB\Field(type: Type::STRING)]
    private $invoice_number;

    #[MongoDB\Field(type: Type::STRING)]
    private $delivery_number;

    #[MongoDB\Field(type: Type::DATE)]
    private $invoiceDate;

    #[MongoDB\Field(type: Type::DATE)]
    private $delivery_date;

    #[MongoDB\Field(type: Type::DATE)]
    private $valid;

    #[MongoDB\Field(type: Type::DATE)]
    private $date_add;

    #[MongoDB\Field(type: Type::DATE)]
    private $date_upd;

    #[MongoDB\Field(type: Type::STRING)]
    private $note;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_order_detail;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_warehouse;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_tax_rules_group;

    #[MongoDB\Field(type: Type::STRING)]
    private $tax_computation_method;

    #[MongoDB\Field(type: Type::STRING)]
    private $tax_name;

    #[MongoDB\Field(type: Type::STRING)]
    private $tax_rate;

    #[MongoDB\Field(type: Type::STRING)]
    private $ecotax;

    #[MongoDB\Field(type: Type::STRING)]
    private $ecotax_tax_rate;

    #[MongoDB\Field(type: Type::STRING)]
    private $discount_quantity_applied;

    #[MongoDB\Field(type: Type::STRING)]
    private $download_hash;

    #[MongoDB\Field(type: Type::STRING)]
    private $download_nb;

    #[MongoDB\Field(type: Type::STRING)]
    private $download_deadline;

    #[MongoDB\Field(type: Type::STRING)]
    private $unit_price_tax_incl;

    #[MongoDB\Field(type: Type::STRING)]
    private $unit_price_tax_excl;

    #[MongoDB\Field(type: Type::STRING)]
    private $purchase_supplier_price;

    #[MongoDB\Field(type: Type::STRING)]
    private $original_product_price;

    #[MongoDB\Field(type: Type::STRING)]
    private $original_wholesale_price;

    #[MongoDB\Field(type: Type::STRING)]
    private $id_order_carrier;

    #[MongoDB\Field(type: Type::STRING)]
    private $weight;

    #[MongoDB\Field(type: Type::STRING)]
    private $tracking_number;
    

    /**
     * Get the value of farmer_id
     */ 
    public function getFarmerId()
    {
        return $this->farmerId;
    }

    /**
     * Set the value of farmer_id
     *
     * @return  self
     */ 
    public function setFarmerId($farmerId)
    {
        $this->farmerId = $farmerId;
        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of id_order
     */ 
    public function getIdOrder()
    {
        return $this->idOrder;
    }

    /**
     * Set the value of id_order
     *
     * @return  self
     */ 
    public function setIdOrder($idOrder)
    {
        $this->idOrder = $idOrder;

        return $this;
    }

    /**
     * Get the value of order_reference
     */ 
    public function getOrder_reference()
    {
        return $this->order_reference;
    }

    /**
     * Set the value of order_reference
     *
     * @return  self
     */ 
    public function setOrder_reference($order_reference)
    {
        $this->order_reference = $order_reference;

        return $this;
    }

    /**
     * Get the value of product_id
     */ 
    public function getProductId()
    {
        return $this->productId;
    }

    /**
     * Set the value of productId
     *
     * @return  self
     */ 
    public function setProductId($productId)
    {
        $this->productId = $productId;

        return $this;
    }

    /**
     * Get the value of product_name
     */ 
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of product_name
     *
     * @return  self
     */ 
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get the value of productQuantity
     */ 
    public function getProductQuantity()
    {
        return $this->productQuantity;
    }

    /**
     * Set the value of productQuantity
     *
     * @return  self
     */ 
    public function setProductQuantity($productQuantity)
    {
        $this->productQuantity = $productQuantity;

        return $this;
    }

    /**
     * Get the value of productPrice
     */ 
    public function getProductPrice()
    {
        return $this->productPrice;
    }

    /**
     * Set the value of productPrice
     *
     * @return  self
     */ 
    public function setProductPrice($productPrice)
    {
        $this->productPrice = $productPrice;

        return $this;
    }

    /**
     * Get the value of product_quantity_in_stock
     */ 
    public function getProduct_quantity_in_stock()
    {
        return $this->product_quantity_in_stock;
    }

    /**
     * Set the value of product_quantity_in_stock
     *
     * @return  self
     */ 
    public function setProduct_quantity_in_stock($product_quantity_in_stock)
    {
        $this->product_quantity_in_stock = $product_quantity_in_stock;

        return $this;
    }

    /**
     * Get the value of product_quantity_refunded
     */ 
    public function getProduct_quantity_refunded()
    {
        return $this->product_quantity_refunded;
    }

    /**
     * Set the value of product_quantity_refunded
     *
     * @return  self
     */ 
    public function setProduct_quantity_refunded($product_quantity_refunded)
    {
        $this->product_quantity_refunded = $product_quantity_refunded;

        return $this;
    }

    /**
     * Get the value of product_quantity_return
     */ 
    public function getProduct_quantity_return()
    {
        return $this->product_quantity_return;
    }

    /**
     * Set the value of product_quantity_return
     *
     * @return  self
     */ 
    public function setProduct_quantity_return($product_quantity_return)
    {
        $this->product_quantity_return = $product_quantity_return;

        return $this;
    }

    /**
     * Get the value of product_quantity_reinjected
     */ 
    public function getProduct_quantity_reinjected()
    {
        return $this->product_quantity_reinjected;
    }

    /**
     * Set the value of product_quantity_reinjected
     *
     * @return  self
     */ 
    public function setProduct_quantity_reinjected($product_quantity_reinjected)
    {
        $this->product_quantity_reinjected = $product_quantity_reinjected;

        return $this;
    }

    /**
     * Get the value of product_quantity_discount
     */ 
    public function getProduct_quantity_discount()
    {
        return $this->product_quantity_discount;
    }

    /**
     * Set the value of product_quantity_discount
     *
     * @return  self
     */ 
    public function setProduct_quantity_discount($product_quantity_discount)
    {
        $this->product_quantity_discount = $product_quantity_discount;

        return $this;
    }

    /**
     * Get the value of product_attribute_id
     */ 
    public function getProduct_attribute_id()
    {
        return $this->product_attribute_id;
    }

    /**
     * Set the value of product_attribute_id
     *
     * @return  self
     */ 
    public function setProduct_attribute_id($product_attribute_id)
    {
        $this->product_attribute_id = $product_attribute_id;

        return $this;
    }

    /**
     * Get the value of product_ean13
     */ 
    public function getProduct_ean13()
    {
        return $this->product_ean13;
    }

    /**
     * Set the value of product_ean13
     *
     * @return  self
     */ 
    public function setProduct_ean13($product_ean13)
    {
        $this->product_ean13 = $product_ean13;

        return $this;
    }

    /**
     * Get the value of product_isbn
     */ 
    public function getProduct_isbn()
    {
        return $this->product_isbn;
    }

    /**
     * Set the value of product_isbn
     *
     * @return  self
     */ 
    public function setProduct_isbn($product_isbn)
    {
        $this->product_isbn = $product_isbn;

        return $this;
    }

    /**
     * Get the value of product_upc
     */ 
    public function getProduct_upc()
    {
        return $this->product_upc;
    }

    /**
     * Set the value of product_upc
     *
     * @return  self
     */ 
    public function setProduct_upc($product_upc)
    {
        $this->product_upc = $product_upc;

        return $this;
    }

    /**
     * Get the value of product_mpn
     */ 
    public function getProduct_mpn()
    {
        return $this->product_mpn;
    }

    /**
     * Set the value of product_mpn
     *
     * @return  self
     */ 
    public function setProduct_mpn($product_mpn)
    {
        $this->product_mpn = $product_mpn;

        return $this;
    }

    /**
     * Get the value of product_reference
     */ 
    public function getProduct_reference()
    {
        return $this->product_reference;
    }

    /**
     * Set the value of product_reference
     *
     * @return  self
     */ 
    public function setProduct_reference($product_reference)
    {
        $this->product_reference = $product_reference;

        return $this;
    }

    /**
     * Get the value of product_supplier_reference
     */ 
    public function getProduct_supplier_reference()
    {
        return $this->product_supplier_reference;
    }

    /**
     * Set the value of product_supplier_reference
     *
     * @return  self
     */ 
    public function setProduct_supplier_reference($product_supplier_reference)
    {
        $this->product_supplier_reference = $product_supplier_reference;

        return $this;
    }

    /**
     * Get the value of productWeight
     */ 
    public function getProductWeight()
    {
        return $this->productWeight;
    }

    /**
     * Set the value of productWeight
     *
     * @return  self
     */ 
    public function setProductWeight($productWeight)
    {
        $this->productWeight = $productWeight;

        return $this;
    }

    /**
     * Get the value of total_discounts
     */ 
    public function getTotal_discounts()
    {
        return $this->total_discounts;
    }

    /**
     * Set the value of total_discounts
     *
     * @return  self
     */ 
    public function setTotal_discounts($total_discounts)
    {
        $this->total_discounts = $total_discounts;

        return $this;
    }

    /**
     * Get the value of total_discounts_tax_incl
     */ 
    public function getTotal_discounts_tax_incl()
    {
        return $this->total_discounts_tax_incl;
    }

    /**
     * Set the value of total_discounts_tax_incl
     *
     * @return  self
     */ 
    public function setTotal_discounts_tax_incl($total_discounts_tax_incl)
    {
        $this->total_discounts_tax_incl = $total_discounts_tax_incl;

        return $this;
    }

    /**
     * Get the value of total_discounts_tax_excl
     */ 
    public function getTotal_discounts_tax_excl()
    {
        return $this->total_discounts_tax_excl;
    }

    /**
     * Set the value of total_discounts_tax_excl
     *
     * @return  self
     */ 
    public function setTotal_discounts_tax_excl($total_discounts_tax_excl)
    {
        $this->total_discounts_tax_excl = $total_discounts_tax_excl;

        return $this;
    }

    /**
     * Get the value of total_paid
     */ 
    public function getTotal_paid()
    {
        return $this->total_paid;
    }

    /**
     * Set the value of total_paid
     *
     * @return  self
     */ 
    public function setTotal_paid($total_paid)
    {
        $this->total_paid = $total_paid;

        return $this;
    }

    /**
     * Get the value of total_paid_tax_incl
     */ 
    public function getTotal_paid_tax_incl()
    {
        return $this->total_paid_tax_incl;
    }

    /**
     * Set the value of total_paid_tax_incl
     *
     * @return  self
     */ 
    public function setTotal_paid_tax_incl($total_paid_tax_incl)
    {
        $this->total_paid_tax_incl = $total_paid_tax_incl;

        return $this;
    }

    /**
     * Get the value of total_paid_tax_excl
     */ 
    public function getTotal_paid_tax_excl()
    {
        return $this->total_paid_tax_excl;
    }

    /**
     * Set the value of total_paid_tax_excl
     *
     * @return  self
     */ 
    public function setTotal_paid_tax_excl($total_paid_tax_excl)
    {
        $this->total_paid_tax_excl = $total_paid_tax_excl;

        return $this;
    }

    /**
     * Get the value of total_paid_real
     */ 
    public function getTotal_paid_real()
    {
        return $this->total_paid_real;
    }

    /**
     * Set the value of total_paid_real
     *
     * @return  self
     */ 
    public function setTotal_paid_real($total_paid_real)
    {
        $this->total_paid_real = $total_paid_real;

        return $this;
    }

    /**
     * Get the value of total_products
     */ 
    public function getTotal_products()
    {
        return $this->total_products;
    }

    /**
     * Set the value of total_products
     *
     * @return  self
     */ 
    public function setTotal_products($total_products)
    {
        $this->total_products = $total_products;

        return $this;
    }

    /**
     * Get the value of total_products_wt
     */ 
    public function getTotal_products_wt()
    {
        return $this->total_products_wt;
    }

    /**
     * Set the value of total_products_wt
     *
     * @return  self
     */ 
    public function setTotal_products_wt($total_products_wt)
    {
        $this->total_products_wt = $total_products_wt;

        return $this;
    }

    /**
     * Get the value of total_shipping
     */ 
    public function getTotal_shipping()
    {
        return $this->total_shipping;
    }

    /**
     * Set the value of total_shipping
     *
     * @return  self
     */ 
    public function setTotal_shipping($total_shipping)
    {
        $this->total_shipping = $total_shipping;

        return $this;
    }

    /**
     * Get the value of total_price_tax_incl
     */ 
    public function getTotal_price_tax_incl()
    {
        return $this->total_price_tax_incl;
    }

    /**
     * Set the value of total_price_tax_incl
     *
     * @return  self
     */ 
    public function setTotal_price_tax_incl($total_price_tax_incl)
    {
        $this->total_price_tax_incl = $total_price_tax_incl;

        return $this;
    }

    /**
     * Get the value of total_price_tax_excl
     */ 
    public function getTotal_price_tax_excl()
    {
        return $this->total_price_tax_excl;
    }

    /**
     * Set the value of total_price_tax_excl
     *
     * @return  self
     */ 
    public function setTotal_price_tax_excl($total_price_tax_excl)
    {
        $this->total_price_tax_excl = $total_price_tax_excl;

        return $this;
    }

    /**
     * Get the value of total_refunded_tax_excl
     */ 
    public function getTotal_refunded_tax_excl()
    {
        return $this->total_refunded_tax_excl;
    }

    /**
     * Set the value of total_refunded_tax_excl
     *
     * @return  self
     */ 
    public function setTotal_refunded_tax_excl($total_refunded_tax_excl)
    {
        $this->total_refunded_tax_excl = $total_refunded_tax_excl;

        return $this;
    }

    /**
     * Get the value of total_refunded_tax_incl
     */ 
    public function getTotal_refunded_tax_incl()
    {
        return $this->total_refunded_tax_incl;
    }

    /**
     * Set the value of total_refunded_tax_incl
     *
     * @return  self
     */ 
    public function setTotal_refunded_tax_incl($total_refunded_tax_incl)
    {
        $this->total_refunded_tax_incl = $total_refunded_tax_incl;

        return $this;
    }

    /**
     * Get the value of total_shipping_price_tax_incl
     */ 
    public function getTotal_shipping_price_tax_incl()
    {
        return $this->total_shipping_price_tax_incl;
    }

    /**
     * Set the value of total_shipping_price_tax_incl
     *
     * @return  self
     */ 
    public function setTotal_shipping_price_tax_incl($total_shipping_price_tax_incl)
    {
        $this->total_shipping_price_tax_incl = $total_shipping_price_tax_incl;

        return $this;
    }

    /**
     * Get the value of total_shipping_price_tax_excl
     */ 
    public function getTotal_shipping_price_tax_excl()
    {
        return $this->total_shipping_price_tax_excl;
    }

    /**
     * Set the value of total_shipping_price_tax_excl
     *
     * @return  self
     */ 
    public function setTotal_shipping_price_tax_excl($total_shipping_price_tax_excl)
    {
        $this->total_shipping_price_tax_excl = $total_shipping_price_tax_excl;

        return $this;
    }

    /**
     * Get the value of shipping_cost_tax_excl
     */ 
    public function getShipping_cost_tax_excl()
    {
        return $this->shipping_cost_tax_excl;
    }

    /**
     * Set the value of shipping_cost_tax_excl
     *
     * @return  self
     */ 
    public function setShipping_cost_tax_excl($shipping_cost_tax_excl)
    {
        $this->shipping_cost_tax_excl = $shipping_cost_tax_excl;

        return $this;
    }

    /**
     * Get the value of shipping_cost_tax_incl
     */ 
    public function getShipping_cost_tax_incl()
    {
        return $this->shipping_cost_tax_incl;
    }

    /**
     * Set the value of shipping_cost_tax_incl
     *
     * @return  self
     */ 
    public function setShipping_cost_tax_incl($shipping_cost_tax_incl)
    {
        $this->shipping_cost_tax_incl = $shipping_cost_tax_incl;

        return $this;
    }

    /**
     * Get the value of id_customization
     */ 
    public function getId_customization()
    {
        return $this->id_customization;
    }

    /**
     * Set the value of id_customization
     *
     * @return  self
     */ 
    public function setId_customization($id_customization)
    {
        $this->id_customization = $id_customization;

        return $this;
    }

    /**
     * Get the value of reduction_percent
     */ 
    public function getReduction_percent()
    {
        return $this->reduction_percent;
    }

    /**
     * Set the value of reduction_percent
     *
     * @return  self
     */ 
    public function setReduction_percent($reduction_percent)
    {
        $this->reduction_percent = $reduction_percent;

        return $this;
    }

    /**
     * Get the value of reduction_amount
     */ 
    public function getReduction_amount()
    {
        return $this->reduction_amount;
    }

    /**
     * Set the value of reduction_amount
     *
     * @return  self
     */ 
    public function setReduction_amount($reduction_amount)
    {
        $this->reduction_amount = $reduction_amount;

        return $this;
    }

    /**
     * Get the value of reduction_amount_tax_incl
     */ 
    public function getReduction_amount_tax_incl()
    {
        return $this->reduction_amount_tax_incl;
    }

    /**
     * Set the value of reduction_amount_tax_incl
     *
     * @return  self
     */ 
    public function setReduction_amount_tax_incl($reduction_amount_tax_incl)
    {
        $this->reduction_amount_tax_incl = $reduction_amount_tax_incl;

        return $this;
    }

    /**
     * Get the value of reduction_amount_tax_excl
     */ 
    public function getReduction_amount_tax_excl()
    {
        return $this->reduction_amount_tax_excl;
    }

    /**
     * Set the value of reduction_amount_tax_excl
     *
     * @return  self
     */ 
    public function setReduction_amount_tax_excl($reduction_amount_tax_excl)
    {
        $this->reduction_amount_tax_excl = $reduction_amount_tax_excl;

        return $this;
    }

    /**
     * Get the value of group_reduction
     */ 
    public function getGroup_reduction()
    {
        return $this->group_reduction;
    }

    /**
     * Set the value of group_reduction
     *
     * @return  self
     */ 
    public function setGroup_reduction($group_reduction)
    {
        $this->group_reduction = $group_reduction;

        return $this;
    }

    /**
     * Get the value of id_shop_group
     */ 
    public function getId_shop_group()
    {
        return $this->id_shop_group;
    }

    /**
     * Set the value of id_shop_group
     *
     * @return  self
     */ 
    public function setId_shop_group($id_shop_group)
    {
        $this->id_shop_group = $id_shop_group;

        return $this;
    }

    /**
     * Get the value of id_shop
     */ 
    public function getId_shop()
    {
        return $this->id_shop;
    }

    /**
     * Set the value of id_shop
     *
     * @return  self
     */ 
    public function setId_shop($id_shop)
    {
        $this->id_shop = $id_shop;

        return $this;
    }

    /**
     * Get the value of id_carrier
     */ 
    public function getId_carrier()
    {
        return $this->id_carrier;
    }

    /**
     * Set the value of id_carrier
     *
     * @return  self
     */ 
    public function setId_carrier($id_carrier)
    {
        $this->id_carrier = $id_carrier;

        return $this;
    }

    /**
     * Get the value of id_lang
     */ 
    public function getId_lang()
    {
        return $this->id_lang;
    }

    /**
     * Set the value of id_lang
     *
     * @return  self
     */ 
    public function setId_lang($id_lang)
    {
        $this->id_lang = $id_lang;

        return $this;
    }

    /**
     * Get the value of id_customer
     */ 
    public function getId_customer()
    {
        return $this->id_customer;
    }

    /**
     * Set the value of id_customer
     *
     * @return  self
     */ 
    public function setId_customer($id_customer)
    {
        $this->id_customer = $id_customer;

        return $this;
    }

    /**
     * Get the value of id_cart
     */ 
    public function getId_cart()
    {
        return $this->id_cart;
    }

    /**
     * Set the value of id_cart
     *
     * @return  self
     */ 
    public function setId_cart($id_cart)
    {
        $this->id_cart = $id_cart;

        return $this;
    }

    /**
     * Get the value of id_currency
     */ 
    public function getId_currency()
    {
        return $this->id_currency;
    }

    /**
     * Set the value of id_currency
     *
     * @return  self
     */ 
    public function setId_currency($id_currency)
    {
        $this->id_currency = $id_currency;

        return $this;
    }

    /**
     * Get the value of d_address_delivery
     */ 
    public function getD_address_delivery()
    {
        return $this->d_address_delivery;
    }

    /**
     * Set the value of d_address_delivery
     *
     * @return  self
     */ 
    public function setD_address_delivery($d_address_delivery)
    {
        $this->d_address_delivery = $d_address_delivery;

        return $this;
    }

    /**
     * Get the value of id_address_invoice
     */ 
    public function getId_address_invoice()
    {
        return $this->id_address_invoice;
    }

    /**
     * Set the value of id_address_invoice
     *
     * @return  self
     */ 
    public function setId_address_invoice($id_address_invoice)
    {
        $this->id_address_invoice = $id_address_invoice;

        return $this;
    }

    /**
     * Get the value of current_state
     */ 
    public function getCurrent_state()
    {
        return $this->current_state;
    }

    /**
     * Set the value of current_state
     *
     * @return  self
     */ 
    public function setCurrent_state($current_state)
    {
        $this->current_state = $current_state;

        return $this;
    }

    /**
     * Get the value of payment
     */ 
    public function getPayment()
    {
        return $this->payment;
    }

    /**
     * Set the value of payment
     *
     * @return  self
     */ 
    public function setPayment($payment)
    {
        $this->payment = $payment;

        return $this;
    }

    /**
     * Get the value of conversion_rate
     */ 
    public function getConversion_rate()
    {
        return $this->conversion_rate;
    }

    /**
     * Set the value of conversion_rate
     *
     * @return  self
     */ 
    public function setConversion_rate($conversion_rate)
    {
        $this->conversion_rate = $conversion_rate;

        return $this;
    }

    /**
     * Get the value of module
     */ 
    public function getModule()
    {
        return $this->module;
    }

    /**
     * Set the value of module
     *
     * @return  self
     */ 
    public function setModule($module)
    {
        $this->module = $module;

        return $this;
    }

    /**
     * Get the value of recyclable
     */ 
    public function getRecyclable()
    {
        return $this->recyclable;
    }

    /**
     * Set the value of recyclable
     *
     * @return  self
     */ 
    public function setRecyclable($recyclable)
    {
        $this->recyclable = $recyclable;

        return $this;
    }

    /**
     * Get the value of gift
     */ 
    public function getGift()
    {
        return $this->gift;
    }

    /**
     * Set the value of gift
     *
     * @return  self
     */ 
    public function setGift($gift)
    {
        $this->gift = $gift;

        return $this;
    }

    /**
     * Get the value of gift_message
     */ 
    public function getGift_message()
    {
        return $this->gift_message;
    }

    /**
     * Set the value of gift_message
     *
     * @return  self
     */ 
    public function setGift_message($gift_message)
    {
        $this->gift_message = $gift_message;

        return $this;
    }

    /**
     * Get the value of mobile_theme
     */ 
    public function getMobile_theme()
    {
        return $this->mobile_theme;
    }

    /**
     * Set the value of mobile_theme
     *
     * @return  self
     */ 
    public function setMobile_theme($mobile_theme)
    {
        $this->mobile_theme = $mobile_theme;

        return $this;
    }

    /**
     * Get the value of shipping_number
     */ 
    public function getShipping_number()
    {
        return $this->shipping_number;
    }

    /**
     * Set the value of shipping_number
     *
     * @return  self
     */ 
    public function setShipping_number($shipping_number)
    {
        $this->shipping_number = $shipping_number;

        return $this;
    }

    /**
     * Get the value of carrier_tax_rate
     */ 
    public function getCarrier_tax_rate()
    {
        return $this->carrier_tax_rate;
    }

    /**
     * Set the value of carrier_tax_rate
     *
     * @return  self
     */ 
    public function setCarrier_tax_rate($carrier_tax_rate)
    {
        $this->carrier_tax_rate = $carrier_tax_rate;

        return $this;
    }

    /**
     * Get the value of total_wrapping
     */ 
    public function getTotal_wrapping()
    {
        return $this->total_wrapping;
    }

    /**
     * Set the value of total_wrapping
     *
     * @return  self
     */ 
    public function setTotal_wrapping($total_wrapping)
    {
        $this->total_wrapping = $total_wrapping;

        return $this;
    }

    /**
     * Get the value of total_wrapping_tax_incl
     */ 
    public function getTotal_wrapping_tax_incl()
    {
        return $this->total_wrapping_tax_incl;
    }

    /**
     * Set the value of total_wrapping_tax_incl
     *
     * @return  self
     */ 
    public function setTotal_wrapping_tax_incl($total_wrapping_tax_incl)
    {
        $this->total_wrapping_tax_incl = $total_wrapping_tax_incl;

        return $this;
    }

    /**
     * Get the value of total_wrapping_tax_excl
     */ 
    public function getTotal_wrapping_tax_excl()
    {
        return $this->total_wrapping_tax_excl;
    }

    /**
     * Set the value of total_wrapping_tax_excl
     *
     * @return  self
     */ 
    public function setTotal_wrapping_tax_excl($total_wrapping_tax_excl)
    {
        $this->total_wrapping_tax_excl = $total_wrapping_tax_excl;

        return $this;
    }

    /**
     * Get the value of round_mode
     */ 
    public function getRound_mode()
    {
        return $this->round_mode;
    }

    /**
     * Set the value of round_mode
     *
     * @return  self
     */ 
    public function setRound_mode($round_mode)
    {
        $this->round_mode = $round_mode;

        return $this;
    }

    /**
     * Get the value of round_type
     */ 
    public function getRound_type()
    {
        return $this->round_type;
    }

    /**
     * Set the value of round_type
     *
     * @return  self
     */ 
    public function setRound_type($round_type)
    {
        $this->round_type = $round_type;

        return $this;
    }

    /**
     * Get the value of invoice_number
     */ 
    public function getInvoice_number()
    {
        return $this->invoice_number;
    }

    /**
     * Set the value of invoice_number
     *
     * @return  self
     */ 
    public function setInvoice_number($invoice_number)
    {
        $this->invoice_number = $invoice_number;

        return $this;
    }

    /**
     * Get the value of delivery_number
     */ 
    public function getDelivery_number()
    {
        return $this->delivery_number;
    }

    /**
     * Set the value of delivery_number
     *
     * @return  self
     */ 
    public function setDelivery_number($delivery_number)
    {
        $this->delivery_number = $delivery_number;

        return $this;
    }

    /**
     * Get the value of invoiceDate
     */ 
    public function getInvoiceDate()
    {
        return $this->invoiceDate;
    }

    /**
     * Set the value of invoiceDate
     *
     * @return  self
     */ 
    public function setInvoiceDate($invoiceDate)
    {
        $this->invoiceDate = $invoiceDate;

        return $this;
    }

    /**
     * Get the value of delivery_date
     */ 
    public function getDelivery_date()
    {
        return $this->delivery_date;
    }

    /**
     * Set the value of delivery_date
     *
     * @return  self
     */ 
    public function setDelivery_date($delivery_date)
    {
        $this->delivery_date = $delivery_date;

        return $this;
    }

    /**
     * Get the value of valid
     */ 
    public function getValid()
    {
        return $this->valid;
    }

    /**
     * Set the value of valid
     *
     * @return  self
     */ 
    public function setValid($valid)
    {
        $this->valid = $valid;

        return $this;
    }

    /**
     * Get the value of date_add
     */ 
    public function getDate_add()
    {
        return $this->date_add;
    }

    /**
     * Set the value of date_add
     *
     * @return  self
     */ 
    public function setDate_add($date_add)
    {
        $this->date_add = $date_add;

        return $this;
    }

    /**
     * Get the value of date_upd
     */ 
    public function getDate_upd()
    {
        return $this->date_upd;
    }

    /**
     * Set the value of date_upd
     *
     * @return  self
     */ 
    public function setDate_upd($date_upd)
    {
        $this->date_upd = $date_upd;

        return $this;
    }

    /**
     * Get the value of note
     */ 
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set the value of note
     *
     * @return  self
     */ 
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get the value of id_order_detail
     */ 
    public function getId_order_detail()
    {
        return $this->id_order_detail;
    }

    /**
     * Set the value of id_order_detail
     *
     * @return  self
     */ 
    public function setId_order_detail($id_order_detail)
    {
        $this->id_order_detail = $id_order_detail;

        return $this;
    }

    /**
     * Get the value of id_warehouse
     */ 
    public function getId_warehouse()
    {
        return $this->id_warehouse;
    }

    /**
     * Set the value of id_warehouse
     *
     * @return  self
     */ 
    public function setId_warehouse($id_warehouse)
    {
        $this->id_warehouse = $id_warehouse;

        return $this;
    }

    /**
     * Get the value of id_tax_rules_group
     */ 
    public function getId_tax_rules_group()
    {
        return $this->id_tax_rules_group;
    }

    /**
     * Set the value of id_tax_rules_group
     *
     * @return  self
     */ 
    public function setId_tax_rules_group($id_tax_rules_group)
    {
        $this->id_tax_rules_group = $id_tax_rules_group;

        return $this;
    }

    /**
     * Get the value of tax_computation_method
     */ 
    public function getTax_computation_method()
    {
        return $this->tax_computation_method;
    }

    /**
     * Set the value of tax_computation_method
     *
     * @return  self
     */ 
    public function setTax_computation_method($tax_computation_method)
    {
        $this->tax_computation_method = $tax_computation_method;

        return $this;
    }

    /**
     * Get the value of tax_name
     */ 
    public function getTax_name()
    {
        return $this->tax_name;
    }

    /**
     * Set the value of tax_name
     *
     * @return  self
     */ 
    public function setTax_name($tax_name)
    {
        $this->tax_name = $tax_name;

        return $this;
    }

    /**
     * Get the value of tax_rate
     */ 
    public function getTax_rate()
    {
        return $this->tax_rate;
    }

    /**
     * Set the value of tax_rate
     *
     * @return  self
     */ 
    public function setTax_rate($tax_rate)
    {
        $this->tax_rate = $tax_rate;

        return $this;
    }

    /**
     * Get the value of ecotax
     */ 
    public function getEcotax()
    {
        return $this->ecotax;
    }

    /**
     * Set the value of ecotax
     *
     * @return  self
     */ 
    public function setEcotax($ecotax)
    {
        $this->ecotax = $ecotax;

        return $this;
    }

    /**
     * Get the value of ecotax_tax_rate
     */ 
    public function getEcotax_tax_rate()
    {
        return $this->ecotax_tax_rate;
    }

    /**
     * Set the value of ecotax_tax_rate
     *
     * @return  self
     */ 
    public function setEcotax_tax_rate($ecotax_tax_rate)
    {
        $this->ecotax_tax_rate = $ecotax_tax_rate;

        return $this;
    }

    /**
     * Get the value of discount_quantity_applied
     */ 
    public function getDiscount_quantity_applied()
    {
        return $this->discount_quantity_applied;
    }

    /**
     * Set the value of discount_quantity_applied
     *
     * @return  self
     */ 
    public function setDiscount_quantity_applied($discount_quantity_applied)
    {
        $this->discount_quantity_applied = $discount_quantity_applied;

        return $this;
    }

    /**
     * Get the value of download_hash
     */ 
    public function getDownload_hash()
    {
        return $this->download_hash;
    }

    /**
     * Set the value of download_hash
     *
     * @return  self
     */ 
    public function setDownload_hash($download_hash)
    {
        $this->download_hash = $download_hash;

        return $this;
    }

    /**
     * Get the value of download_nb
     */ 
    public function getDownload_nb()
    {
        return $this->download_nb;
    }

    /**
     * Set the value of download_nb
     *
     * @return  self
     */ 
    public function setDownload_nb($download_nb)
    {
        $this->download_nb = $download_nb;

        return $this;
    }

    /**
     * Get the value of download_deadline
     */ 
    public function getDownload_deadline()
    {
        return $this->download_deadline;
    }

    /**
     * Set the value of download_deadline
     *
     * @return  self
     */ 
    public function setDownload_deadline($download_deadline)
    {
        $this->download_deadline = $download_deadline;

        return $this;
    }

    /**
     * Get the value of unit_price_tax_incl
     */ 
    public function getUnit_price_tax_incl()
    {
        return $this->unit_price_tax_incl;
    }

    /**
     * Set the value of unit_price_tax_incl
     *
     * @return  self
     */ 
    public function setUnit_price_tax_incl($unit_price_tax_incl)
    {
        $this->unit_price_tax_incl = $unit_price_tax_incl;

        return $this;
    }

    /**
     * Get the value of unit_price_tax_excl
     */ 
    public function getUnit_price_tax_excl()
    {
        return $this->unit_price_tax_excl;
    }

    /**
     * Set the value of unit_price_tax_excl
     *
     * @return  self
     */ 
    public function setUnit_price_tax_excl($unit_price_tax_excl)
    {
        $this->unit_price_tax_excl = $unit_price_tax_excl;

        return $this;
    }

    /**
     * Get the value of purchase_supplier_price
     */ 
    public function getPurchase_supplier_price()
    {
        return $this->purchase_supplier_price;
    }

    /**
     * Set the value of purchase_supplier_price
     *
     * @return  self
     */ 
    public function setPurchase_supplier_price($purchase_supplier_price)
    {
        $this->purchase_supplier_price = $purchase_supplier_price;

        return $this;
    }

    /**
     * Get the value of original_product_price
     */ 
    public function getOriginal_product_price()
    {
        return $this->original_product_price;
    }

    /**
     * Set the value of original_product_price
     *
     * @return  self
     */ 
    public function setOriginal_product_price($original_product_price)
    {
        $this->original_product_price = $original_product_price;

        return $this;
    }

    /**
     * Get the value of original_wholesale_price
     */ 
    public function getOriginal_wholesale_price()
    {
        return $this->original_wholesale_price;
    }

    /**
     * Set the value of original_wholesale_price
     *
     * @return  self
     */ 
    public function setOriginal_wholesale_price($original_wholesale_price)
    {
        $this->original_wholesale_price = $original_wholesale_price;

        return $this;
    }

    /**
     * Get the value of id_order_carrier
     */ 
    public function getId_order_carrier()
    {
        return $this->id_order_carrier;
    }

    /**
     * Set the value of id_order_carrier
     *
     * @return  self
     */ 
    public function setId_order_carrier($id_order_carrier)
    {
        $this->id_order_carrier = $id_order_carrier;

        return $this;
    }

    /**
     * Get the value of weight
     */ 
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */ 
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }

    /**
     * Get the value of tracking_number
     */ 
    public function getTracking_number()
    {
        return $this->tracking_number;
    }

    /**
     * Set the value of tracking_number
     *
     * @return  self
     */ 
    public function setTracking_number($tracking_number)
    {
        $this->tracking_number = $tracking_number;

        return $this;
    }
}