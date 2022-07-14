<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_profile")]
class FarmerGroup
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;

    private $groups_id; 
    private $groups_name;
    private $groups_idnumber;
    private $groups_year;

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
     * Get the value of groups_id
     */ 
    public function getGroups_id()
    {
        return $this->groups_id;
    }

    /**
     * Set the value of groups_id
     *
     * @return  self
     */ 
    public function setGroups_id($groups_id)
    {
        $this->groups_id = $groups_id;

        return $this;
    }

    /**
     * Get the value of groups_name
     */ 
    public function getGroups_name()
    {
        return $this->groups_name;
    }

    /**
     * Set the value of groups_name
     *
     * @return  self
     */ 
    public function setGroups_name($groups_name)
    {
        $this->groups_name = $groups_name;

        return $this;
    }

    /**
     * Get the value of groups_idnumber
     */ 
    public function getGroups_idnumber()
    {
        return $this->groups_idnumber;
    }

    /**
     * Set the value of groups_idnumber
     *
     * @return  self
     */ 
    public function setGroups_idnumber($groups_idnumber)
    {
        $this->groups_idnumber = $groups_idnumber;

        return $this;
    }

    /**
     * Get the value of groups_year
     */ 
    public function getGroups_year()
    {
        return $this->groups_year;
    }

    /**
     * Set the value of groups_year
     *
     * @return  self
     */ 
    public function setGroups_year($groups_year)
    {
        $this->groups_year = $groups_year;

        return $this;
    }
}