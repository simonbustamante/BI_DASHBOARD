<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "mayani_inventory_process")]
class MayaniInventory
{
    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: Type::STRING)]
    private $mProductInventoryId;

    #[MongoDB\Field(type: Type::STRING)]
    private $mProductInventoryDescription;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $mProductInventoryTotalKg;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $mProductInventoryTotalValue;

    #[MongoDB\Field(type: Type::STRING)]
    private $mRequestInventoryId;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $mRequestInventoryKg;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $mRequestInventoryDebt;

    #[MongoDB\Field(type: Type::DATE)]
    private $mRequestInventoryDate;

    #[MongoDB\Field(type: Type::STRING)]
    private $mRequestInventoryDescription;

    #[MongoDB\Field(type: Type::STRING)]
    private $farmInventoryId;

    #[MongoDB\Field(type: Type::STRING)]
    private $b2cProductRequestId;

    #[MongoDB\Field(type: Type::STRING)]
    private $b2cProductRequestDescription;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $b2cProductRequestKg;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $b2cProductRequestTotalDebt;

    #[MongoDB\Field(type: Type::DATE)]
    private $b2cProductRequestDate;

    #[MongoDB\Field(type: Type::STRING)]
    private $farmerBalanceId;
    
    

   

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
     * Get the value of mProductInventoryId
     */ 
    public function getMProductInventoryId()
    {
        return $this->mProductInventoryId;
    }

    /**
     * Set the value of mProductInventoryId
     *
     * @return  self
     */ 
    public function setMProductInventoryId($mProductInventoryId)
    {
        $this->mProductInventoryId = $mProductInventoryId;

        return $this;
    }

    /**
     * Get the value of mProductInventoryDescription
     */ 
    public function getMProductInventoryDescription()
    {
        return $this->mProductInventoryDescription;
    }

    /**
     * Set the value of mProductInventoryDescription
     *
     * @return  self
     */ 
    public function setMProductInventoryDescription($mProductInventoryDescription)
    {
        $this->mProductInventoryDescription = $mProductInventoryDescription;

        return $this;
    }

    /**
     * Get the value of mProductInventoryTotalKg
     */ 
    public function getMProductInventoryTotalKg()
    {
        return $this->mProductInventoryTotalKg;
    }

    /**
     * Set the value of mProductInventoryTotalKg
     *
     * @return  self
     */ 
    public function setMProductInventoryTotalKg($mProductInventoryTotalKg)
    {
        $this->mProductInventoryTotalKg = $mProductInventoryTotalKg;

        return $this;
    }

    /**
     * Get the value of mProductInventoryTotalValue
     */ 
    public function getMProductInventoryTotalValue()
    {
        return $this->mProductInventoryTotalValue;
    }

    /**
     * Set the value of mProductInventoryTotalValue
     *
     * @return  self
     */ 
    public function setMProductInventoryTotalValue($mProductInventoryTotalValue)
    {
        $this->mProductInventoryTotalValue = $mProductInventoryTotalValue;

        return $this;
    }

    /**
     * Get the value of mRequestInventoryId
     */ 
    public function getMRequestInventoryId()
    {
        return $this->mRequestInventoryId;
    }

    /**
     * Set the value of mRequestInventoryId
     *
     * @return  self
     */ 
    public function setMRequestInventoryId($mRequestInventoryId)
    {
        $this->mRequestInventoryId = $mRequestInventoryId;

        return $this;
    }

    /**
     * Get the value of mRequestInventoryKg
     */ 
    public function getMRequestInventoryKg()
    {
        return $this->mRequestInventoryKg;
    }

    /**
     * Set the value of mRequestInventoryKg
     *
     * @return  self
     */ 
    public function setMRequestInventoryKg($mRequestInventoryKg)
    {
        $this->mRequestInventoryKg = $mRequestInventoryKg;

        return $this;
    }

    /**
     * Get the value of mRequestInventoryDebt
     */ 
    public function getMRequestInventoryDebt()
    {
        return $this->mRequestInventoryDebt;
    }

    /**
     * Set the value of mRequestInventoryDebt
     *
     * @return  self
     */ 
    public function setMRequestInventoryDebt($mRequestInventoryDebt)
    {
        $this->mRequestInventoryDebt = $mRequestInventoryDebt;

        return $this;
    }

    /**
     * Get the value of mRequestInventoryDate
     */ 
    public function getMRequestInventoryDate()
    {
        return $this->mRequestInventoryDate;
    }

    /**
     * Set the value of mRequestInventoryDate
     *
     * @return  self
     */ 
    public function setMRequestInventoryDate($mRequestInventoryDate)
    {
        $this->mRequestInventoryDate = $mRequestInventoryDate;

        return $this;
    }

    /**
     * Get the value of mRequestInventoryDescription
     */ 
    public function getMRequestInventoryDescription()
    {
        return $this->mRequestInventoryDescription;
    }

    /**
     * Set the value of mRequestInventoryDescription
     *
     * @return  self
     */ 
    public function setMRequestInventoryDescription($mRequestInventoryDescription)
    {
        $this->mRequestInventoryDescription = $mRequestInventoryDescription;

        return $this;
    }

    /**
     * Get the value of farmInventoryId
     */ 
    public function getFarmInventoryId()
    {
        return $this->farmInventoryId;
    }

    /**
     * Set the value of farmInventoryId
     *
     * @return  self
     */ 
    public function setFarmInventoryId($farmInventoryId)
    {
        $this->farmInventoryId = $farmInventoryId;

        return $this;
    }

    /**
     * Get the value of b2cProductRequestId
     */ 
    public function getB2cProductRequestId()
    {
        return $this->b2cProductRequestId;
    }

    /**
     * Set the value of b2cProductRequestId
     *
     * @return  self
     */ 
    public function setB2cProductRequestId($b2cProductRequestId)
    {
        $this->b2cProductRequestId = $b2cProductRequestId;

        return $this;
    }

    /**
     * Get the value of b2cProductRequestDescription
     */ 
    public function getB2cProductRequestDescription()
    {
        return $this->b2cProductRequestDescription;
    }

    /**
     * Set the value of b2cProductRequestDescription
     *
     * @return  self
     */ 
    public function setB2cProductRequestDescription($b2cProductRequestDescription)
    {
        $this->b2cProductRequestDescription = $b2cProductRequestDescription;

        return $this;
    }

    /**
     * Get the value of b2cProductRequestKg
     */ 
    public function getB2cProductRequestKg()
    {
        return $this->b2cProductRequestKg;
    }

    /**
     * Set the value of b2cProductRequestKg
     *
     * @return  self
     */ 
    public function setB2cProductRequestKg($b2cProductRequestKg)
    {
        $this->b2cProductRequestKg = $b2cProductRequestKg;

        return $this;
    }

    /**
     * Get the value of b2cProductRequestTotalDebt
     */ 
    public function getB2cProductRequestTotalDebt()
    {
        return $this->b2cProductRequestTotalDebt;
    }

    /**
     * Set the value of b2cProductRequestTotalDebt
     *
     * @return  self
     */ 
    public function setB2cProductRequestTotalDebt($b2cProductRequestTotalDebt)
    {
        $this->b2cProductRequestTotalDebt = $b2cProductRequestTotalDebt;

        return $this;
    }

    /**
     * Get the value of b2cProductRequestDate
     */ 
    public function getB2cProductRequestDate()
    {
        return $this->b2cProductRequestDate;
    }

    /**
     * Set the value of b2cProductRequestDate
     *
     * @return  self
     */ 
    public function setB2cProductRequestDate($b2cProductRequestDate)
    {
        $this->b2cProductRequestDate = $b2cProductRequestDate;

        return $this;
    }

    /**
     * Get the value of farmerBalanceId
     */ 
    public function getFarmerBalanceId()
    {
        return $this->farmerBalanceId;
    }

    /**
     * Set the value of farmerBalanceId
     *
     * @return  self
     */ 
    public function setFarmerBalanceId($farmerBalanceId)
    {
        $this->farmerBalanceId = $farmerBalanceId;

        return $this;
    }
}