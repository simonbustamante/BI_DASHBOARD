<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_product")]
class FarmerProduct
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventory_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $product_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventory_date;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventory_total_credit;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventory_total_kg;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventory_description;
    #[MongoDB\Field(type: Type::STRING)]
    private $product_name;
    #[MongoDB\Field(type: Type::STRING)]
    private $price_per_kg;
    #[MongoDB\Field(type: Type::STRING)]
    private $kg_per_month;
    #[MongoDB\Field(type: Type::STRING)]
    private $activity_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $activity_name;
    #[MongoDB\Field(type: Type::STRING)]
    private $activity_description;
    

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
     * Get the value of inventory_id
     */ 
    public function getInventory_id()
    {
        return $this->inventory_id;
    }

    /**
     * Set the value of inventory_id
     *
     * @return  self
     */ 
    public function setInventory_id($inventory_id)
    {
        $this->inventory_id = $inventory_id;

        return $this;
    }

    /**
     * Get the value of product_id
     */ 
    public function getProduct_id()
    {
        return $this->product_id;
    }

    /**
     * Set the value of product_id
     *
     * @return  self
     */ 
    public function setProduct_id($product_id)
    {
        $this->product_id = $product_id;

        return $this;
    }

    /**
     * Get the value of inventory_date
     */ 
    public function getInventory_date()
    {
        return $this->inventory_date;
    }

    /**
     * Set the value of inventory_date
     *
     * @return  self
     */ 
    public function setInventory_date($inventory_date)
    {
        $this->inventory_date = $inventory_date;

        return $this;
    }

    /**
     * Get the value of inventory_total_credit
     */ 
    public function getInventory_total_credit()
    {
        return $this->inventory_total_credit;
    }

    /**
     * Set the value of inventory_total_credit
     *
     * @return  self
     */ 
    public function setInventory_total_credit($inventory_total_credit)
    {
        $this->inventory_total_credit = $inventory_total_credit;

        return $this;
    }

    /**
     * Get the value of inventory_total_kg
     */ 
    public function getInventory_total_kg()
    {
        return $this->inventory_total_kg;
    }

    /**
     * Set the value of inventory_total_kg
     *
     * @return  self
     */ 
    public function setInventory_total_kg($inventory_total_kg)
    {
        $this->inventory_total_kg = $inventory_total_kg;

        return $this;
    }

    /**
     * Get the value of inventory_description
     */ 
    public function getInventory_description()
    {
        return $this->inventory_description;
    }

    /**
     * Set the value of inventory_description
     *
     * @return  self
     */ 
    public function setInventory_description($inventory_description)
    {
        $this->inventory_description = $inventory_description;

        return $this;
    }

    /**
     * Get the value of product_name
     */ 
    public function getProduct_name()
    {
        return $this->product_name;
    }

    /**
     * Set the value of product_name
     *
     * @return  self
     */ 
    public function setProduct_name($product_name)
    {
        $this->product_name = $product_name;

        return $this;
    }

    /**
     * Get the value of price_per_kg
     */ 
    public function getPrice_per_kg()
    {
        return $this->price_per_kg;
    }

    /**
     * Set the value of price_per_kg
     *
     * @return  self
     */ 
    public function setPrice_per_kg($price_per_kg)
    {
        $this->price_per_kg = $price_per_kg;

        return $this;
    }

    /**
     * Get the value of kg_per_month
     */ 
    public function getKg_per_month()
    {
        return $this->kg_per_month;
    }

    /**
     * Set the value of kg_per_month
     *
     * @return  self
     */ 
    public function setKg_per_month($kg_per_month)
    {
        $this->kg_per_month = $kg_per_month;

        return $this;
    }

    /**
     * Get the value of activity_id
     */ 
    public function getActivity_id()
    {
        return $this->activity_id;
    }

    /**
     * Set the value of activity_id
     *
     * @return  self
     */ 
    public function setActivity_id($activity_id)
    {
        $this->activity_id = $activity_id;

        return $this;
    }

    /**
     * Get the value of activity_name
     */ 
    public function getActivity_name()
    {
        return $this->activity_name;
    }

    /**
     * Set the value of activity_name
     *
     * @return  self
     */ 
    public function setActivity_name($activity_name)
    {
        $this->activity_name = $activity_name;

        return $this;
    }

    /**
     * Get the value of activity_description
     */ 
    public function getActivity_description()
    {
        return $this->activity_description;
    }

    /**
     * Set the value of activity_description
     *
     * @return  self
     */ 
    public function setActivity_description($activity_description)
    {
        $this->activity_description = $activity_description;

        return $this;
    }
}