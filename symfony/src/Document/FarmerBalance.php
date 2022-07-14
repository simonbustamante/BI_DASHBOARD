<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_balance")]
class FarmerBalance
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;

    #[MongoDB\Field(type: Type::STRING)]
    private $balanceId;

    #[MongoDB\Field(type: Type::STRING)]
    private $debt;

    #[MongoDB\Field(type: Type::STRING)]
    private $credit;

    #[MongoDB\Field(type: Type::STRING)]
    private $monthlyFee;

    #[MongoDB\Field(type: Type::STRING)]
    private $farmerDescription;

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
     * Get the value of balanceId
     */ 
    public function getBalanceId()
    {
        return $this->balanceId;
    }

    /**
     * Set the value of balanceId
     *
     * @return  self
     */ 
    public function setBalanceId($balanceId)
    {
        $this->balanceId = $balanceId;
        
        return $this;
    }

    /**
     * Get the value of debt
     */ 
    public function getDebt()
    {
        return $this->debt;
    }

    /**
     * Set the value of debt
     *
     * @return  self
     */ 
    public function setDebt($debt)
    {
        $this->debt = $debt;

        return $this;
    }

    /**
     * Get the value of credit
     */ 
    public function getCredit()
    {
        return $this->credit;
    }

    /**
     * Set the value of credit
     *
     * @return  self
     */ 
    public function setCredit($credit)
    {
        $this->credit = $credit;

        return $this;
    }

    /**
     * Get the value of monthlyFee
     */ 
    public function getMonthlyFee()
    {
        return $this->monthlyFee;
    }

    /**
     * Set the value of monthlyFee
     *
     * @return  self
     */ 
    public function setMonthlyFee($monthlyFee)
    {
        $this->monthlyFee = $monthlyFee;

        return $this;
    }

    /**
     * Get the value of farmerDescription
     */ 
    public function getFarmerDescription()
    {
        return $this->farmerDescription;
    }

    /**
     * Set the value of farmerDescription
     *
     * @return  self
     */ 
    public function setFarmerDescription($farmerDescription)
    {
        $this->farmerDescription = $farmerDescription;

        return $this;
    }
}