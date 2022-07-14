<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_profile")]
class FarmerLoanPayment
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_payment_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $farmer_balance_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_date;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_quantity_paid;
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
     * Get the value of loan_payment_id
     */ 
    public function getLoan_payment_id()
    {
        return $this->loan_payment_id;
    }

    /**
     * Set the value of loan_payment_id
     *
     * @return  self
     */ 
    public function setLoan_payment_id($loan_payment_id)
    {
        $this->loan_payment_id = $loan_payment_id;

        return $this;
    }

    /**
     * Get the value of farmer_balance_id
     */ 
    public function getFarmer_balance_id()
    {
        return $this->farmer_balance_id;
    }

    /**
     * Set the value of farmer_balance_id
     *
     * @return  self
     */ 
    public function setFarmer_balance_id($farmer_balance_id)
    {
        $this->farmer_balance_id = $farmer_balance_id;

        return $this;
    }

    /**
     * Get the value of loan_id
     */ 
    public function getLoan_id()
    {
        return $this->loan_id;
    }

    /**
     * Set the value of loan_id
     *
     * @return  self
     */ 
    public function setLoan_id($loan_id)
    {
        $this->loan_id = $loan_id;

        return $this;
    }

    /**
     * Get the value of loan_date
     */ 
    public function getLoan_date()
    {
        return $this->loan_date;
    }

    /**
     * Set the value of loan_date
     *
     * @return  self
     */ 
    public function setLoan_date($loan_date)
    {
        $this->loan_date = $loan_date;

        return $this;
    }

    /**
     * Get the value of loan_quantity_paid
     */ 
    public function getLoan_quantity_paid()
    {
        return $this->loan_quantity_paid;
    }

    /**
     * Set the value of loan_quantity_paid
     *
     * @return  self
     */ 
    public function setLoan_quantity_paid($loan_quantity_paid)
    {
        $this->loan_quantity_paid = $loan_quantity_paid;

        return $this;
    }
}