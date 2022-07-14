<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_loan_details")]
class FarmerLoanDetails
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_debt;
    #[MongoDB\Field(type: Type::STRING)]
    private $time_to_pay;
    #[MongoDB\Field(type: Type::STRING)]
    private $monthly_fee;
    #[MongoDB\Field(type: Type::STRING)]
    private $date_of_approval;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_status;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_description;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_type_id;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_type_name;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_type_description;
    #[MongoDB\Field(type: Type::STRING)]
    private $loan_interest;


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
     * Get the value of loan_debt
     */ 
    public function getLoan_debt()
    {
        return $this->loan_debt;
    }

    /**
     * Set the value of loan_debt
     *
     * @return  self
     */ 
    public function setLoan_debt($loan_debt)
    {
        $this->loan_debt = $loan_debt;

        return $this;
    }

    /**
     * Get the value of time_to_pay
     */ 
    public function getTime_to_pay()
    {
        return $this->time_to_pay;
    }

    /**
     * Set the value of time_to_pay
     *
     * @return  self
     */ 
    public function setTime_to_pay($time_to_pay)
    {
        $this->time_to_pay = $time_to_pay;

        return $this;
    }

    /**
     * Get the value of monthly_fee
     */ 
    public function getMonthly_fee()
    {
        return $this->monthly_fee;
    }

    /**
     * Set the value of monthly_fee
     *
     * @return  self
     */ 
    public function setMonthly_fee($monthly_fee)
    {
        $this->monthly_fee = $monthly_fee;

        return $this;
    }

    /**
     * Get the value of date_of_approval
     */ 
    public function getDate_of_approval()
    {
        return $this->date_of_approval;
    }

    /**
     * Set the value of date_of_approval
     *
     * @return  self
     */ 
    public function setDate_of_approval($date_of_approval)
    {
        $this->date_of_approval = $date_of_approval;

        return $this;
    }

    /**
     * Get the value of loan_status
     */ 
    public function getLoan_status()
    {
        return $this->loan_status;
    }

    /**
     * Set the value of loan_status
     *
     * @return  self
     */ 
    public function setLoan_status($loan_status)
    {
        $this->loan_status = $loan_status;

        return $this;
    }

    /**
     * Get the value of loan_description
     */ 
    public function getLoan_description()
    {
        return $this->loan_description;
    }

    /**
     * Set the value of loan_description
     *
     * @return  self
     */ 
    public function setLoan_description($loan_description)
    {
        $this->loan_description = $loan_description;

        return $this;
    }

    /**
     * Get the value of loan_type_id
     */ 
    public function getLoan_type_id()
    {
        return $this->loan_type_id;
    }

    /**
     * Set the value of loan_type_id
     *
     * @return  self
     */ 
    public function setLoan_type_id($loan_type_id)
    {
        $this->loan_type_id = $loan_type_id;

        return $this;
    }

    /**
     * Get the value of loan_type_name
     */ 
    public function getLoan_type_name()
    {
        return $this->loan_type_name;
    }

    /**
     * Set the value of loan_type_name
     *
     * @return  self
     */ 
    public function setLoan_type_name($loan_type_name)
    {
        $this->loan_type_name = $loan_type_name;

        return $this;
    }

    /**
     * Get the value of loan_type_description
     */ 
    public function getLoan_type_description()
    {
        return $this->loan_type_description;
    }

    /**
     * Set the value of loan_type_description
     *
     * @return  self
     */ 
    public function setLoan_type_description($loan_type_description)
    {
        $this->loan_type_description = $loan_type_description;

        return $this;
    }

    /**
     * Get the value of loan_interest
     */ 
    public function getLoan_interest()
    {
        return $this->loan_interest;
    }

    /**
     * Set the value of loan_interest
     *
     * @return  self
     */ 
    public function setLoan_interest($loan_interest)
    {
        $this->loan_interest = $loan_interest;

        return $this;
    }
}