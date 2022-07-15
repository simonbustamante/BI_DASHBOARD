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
    private $inventoryupdateid;
    #[MongoDB\Field(type: Type::STRING)]
    private $inventoryid;
    #[MongoDB\Field(type: Type::STRING)]
    private $quantitykg;
    #[MongoDB\Field(type: Type::STRING)]
    private $credit;
    #[MongoDB\Field(type: Type::STRING)]
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
    public function getInventoryupdateid()
    {
        return $this->inventoryupdateid;
    }

    /**
     * Set the value of inventoryupdateid
     *
     * @return  self
     */ 
    public function setInventoryupdateid($inventoryupdateid)
    {
        $this->inventoryupdateid = $inventoryupdateid;

        return $this;
    }

    /**
     * Get the value of inventoryid
     */ 
    public function getInventoryid()
    {
        return $this->inventoryid;
    }

    /**
     * Set the value of inventoryid
     *
     * @return  self
     */ 
    public function setInventoryid($inventoryid)
    {
        $this->inventoryid = $inventoryid;

        return $this;
    }

    /**
     * Get the value of quantitykg
     */ 
    public function getQuantitykg()
    {
        return $this->quantitykg;
    }

    /**
     * Set the value of quantitykg
     *
     * @return  self
     */ 
    public function setQuantitykg($quantitykg)
    {
        $this->quantitykg = $quantitykg;

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