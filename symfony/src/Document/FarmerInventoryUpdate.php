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

    private $farmer_id;
    private $inventory_update_id;
    private $inventory_id;
    private $quantity_kg;
    private $credit;
    private $date;

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
     * Get the value of farmer_id
     */ 
    public function getFarmer_id()
    {
        return $this->farmer_id;
    }

    /**
     * Set the value of farmer_id
     *
     * @return  self
     */ 
    public function setFarmer_id($farmer_id)
    {
        $this->farmer_id = $farmer_id;

        return $this;
    }

    /**
     * Get the value of inventory_update_id
     */ 
    public function getInventory_update_id()
    {
        return $this->inventory_update_id;
    }

    /**
     * Set the value of inventory_update_id
     *
     * @return  self
     */ 
    public function setInventory_update_id($inventory_update_id)
    {
        $this->inventory_update_id = $inventory_update_id;

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
     * Get the value of quantity_kg
     */ 
    public function getQuantity_kg()
    {
        return $this->quantity_kg;
    }

    /**
     * Set the value of quantity_kg
     *
     * @return  self
     */ 
    public function setQuantity_kg($quantity_kg)
    {
        $this->quantity_kg = $quantity_kg;

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