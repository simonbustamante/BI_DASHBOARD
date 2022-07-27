<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_inventory_update")]
class FarmerInventoryUpdate
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventoryUpdateId;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventoryId;
    #[MongoDB\Field(type: Type::FLOAT)]
    private $quantityKg;
    #[MongoDB\Field(type: Type::FLOAT)]
    private $credit;
    #[MongoDB\Field(type: Type::DATE)]
    private $date;

    /**
     * Get the value of farmerid
     */ 
    public function getFarmerId()
    {
        return $this->farmerId;
    }

    /**
     * Set the value of farmerid
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
     * Get the value of inventoryupdateid
     */ 
    public function getInventoryUpdateId()
    {
        return $this->inventoryUpdateId;
    }

    /**
     * Set the value of inventoryupdateid
     *
     * @return  self
     */ 
    public function setInventoryUpdateId($inventoryUpdateId)
    {
        $this->inventoryUpdateId = $inventoryUpdateId;

        return $this;
    }

    /**
     * Get the value of inventoryid
     */ 
    public function getInventoryId()
    {
        return $this->inventoryId;
    }

    /**
     * Set the value of inventoryid
     *
     * @return  self
     */ 
    public function setInventoryId($inventoryId)
    {
        $this->inventoryId = $inventoryId;

        return $this;
    }

    /**
     * Get the value of quantitykg
     */ 
    public function getQuantityKg()
    {
        return $this->quantityKg;
    }

    /**
     * Set the value of quantitykg
     *
     * @return  self
     */ 
    public function setQuantityKg($quantityKg)
    {
        $this->quantityKg = $quantityKg;

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
     * Get the value of date
     */ 
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set the value of date
     *
     * @return  self
     */ 
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }
}