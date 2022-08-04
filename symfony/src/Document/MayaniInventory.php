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
    private $farmerId;

    #[MongoDB\Field(type: Type::STRING)]
    private $farmerBalanceId;
    
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
    private $farmInventoryId;


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
     * Get the value of farmerId
     */ 
    public function getFarmerId()
    {
        return $this->farmerId;
    }

    /**
     * Set the value of farmerId
     *
     * @return  self
     */ 
    public function setFarmerId($farmerId)
    {
        $this->farmerId = $farmerId;

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
}    