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
    private $inventoryId;
    #[MongoDB\Field(type: Type::STRING)]
    private $productId;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventoryDate;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventoryTotalCredit;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventoryTotalKg;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventoryDescription;
    #[MongoDB\Field(type: Type::STRING)]
    private $productName;
    #[MongoDB\Field(type: Type::STRING)]
    private $pricePerKg;
    #[MongoDB\Field(type: Type::STRING)]
    private $kgPerMonth;
    #[MongoDB\Field(type: Type::STRING)]
    private $activityId;
    #[MongoDB\Field(type: Type::STRING)]
    private $activityName;
    #[MongoDB\Field(type: Type::STRING)]
    private $activityDescription;
    

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
     * Get the value of inventoryId
     */ 
    public function getInventoryId()
    {
        return $this->inventoryId;
    }

    /**
     * Set the value of inventoryId
     *
     * @return  self
     */ 
    public function setInventoryId($inventoryId)
    {
        $this->inventoryId = $inventoryId;

        return $this;
    }

    /**
     * Get the value of productId
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
     * Get the value of inventoryDate
     */ 
    public function getInventoryDate()
    {
        return $this->inventoryDate;
    }

    /**
     * Set the value of inventoryDate
     *
     * @return  self
     */ 
    public function setInventoryDate($inventoryDate)
    {
        $this->inventoryDate = $inventoryDate;

        return $this;
    }

    /**
     * Get the value of inventoryTotalCredit
     */ 
    public function getInventoryTotalCredit()
    {
        return $this->inventoryTotalCredit;
    }

    /**
     * Set the value of inventoryTotalCredit
     *
     * @return  self
     */ 
    public function setInventoryTotalCredit($inventoryTotalCredit)
    {
        $this->inventoryTotalCredit = $inventoryTotalCredit;

        return $this;
    }

    /**
     * Get the value of inventoryTotalKg
     */ 
    public function getInventoryTotalKg()
    {
        return $this->inventoryTotalKg;
    }

    /**
     * Set the value of inventoryTotalKg
     *
     * @return  self
     */ 
    public function setInventoryTotalKg($inventoryTotalKg)
    {
        $this->inventoryTotalKg = $inventoryTotalKg;

        return $this;
    }

    /**
     * Get the value of inventoryDescription
     */ 
    public function getInventoryDescription()
    {
        return $this->inventoryDescription;
    }

    /**
     * Set the value of inventoryDescription
     *
     * @return  self
     */ 
    public function setInventoryDescription($inventoryDescription)
    {
        $this->inventoryDescription = $inventoryDescription;

        return $this;
    }

    /**
     * Get the value of productName
     */ 
    public function getProductName()
    {
        return $this->productName;
    }

    /**
     * Set the value of productName
     *
     * @return  self
     */ 
    public function setProductName($productName)
    {
        $this->productName = $productName;

        return $this;
    }

    /**
     * Get the value of pricePerKg
     */ 
    public function getPricePerKg()
    {
        return $this->pricePerKg;
    }

    /**
     * Set the value of pricePerKg
     *
     * @return  self
     */ 
    public function setPricePerKg($pricePerKg)
    {
        $this->pricePerKg = $pricePerKg;

        return $this;
    }

    /**
     * Get the value of kgPerMonth
     */ 
    public function getKgPerMonth()
    {
        return $this->kgPerMonth;
    }

    /**
     * Set the value of kgPerMonth
     *
     * @return  self
     */ 
    public function setKgPerMonth($kgPerMonth)
    {
        $this->kgPerMonth = $kgPerMonth;

        return $this;
    }

    /**
     * Get the value of activityId
     */ 
    public function getActivityId()
    {
        return $this->activityId;
    }

    /**
     * Set the value of activityId
     *
     * @return  self
     */ 
    public function setActivityId($activityId)
    {
        $this->activityId = $activityId;

        return $this;
    }

    /**
     * Get the value of activityName
     */ 
    public function getActivityName()
    {
        return $this->activityName;
    }

    /**
     * Set the value of activityName
     *
     * @return  self
     */ 
    public function setActivityName($activityName)
    {
        $this->activityName = $activityName;

        return $this;
    }

    /**
     * Get the value of activityDescription
     */ 
    public function getActivityDescription()
    {
        return $this->activityDescription;
    }

    /**
     * Set the value of activityDescription
     *
     * @return  self
     */ 
    public function setActivityDescription($activityDescription)
    {
        $this->activityDescription = $activityDescription;

        return $this;
    }
}