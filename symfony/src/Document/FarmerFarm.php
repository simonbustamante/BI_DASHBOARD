<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_farm")]
class FarmerFarm
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;

    #[MongoDB\Field(type: Type::STRING)]
    private $farmId;

    #[MongoDB\Field(type: Type::STRING)]
    private $farmName;
    
    #[MongoDB\Field(type: Type::STRING)]
    private $farmHouse;
    
    #[MongoDB\Field(type: Type::STRING)]
    private $farmStreet;
    
    #[MongoDB\Field(type: Type::STRING)]
    private $farmBarangay;
    
    #[MongoDB\Field(type: Type::STRING)]
    private $farmMunicipality;
    
    #[MongoDB\Field(type: Type::STRING)]
    private $farmProvince;
    
    #[MongoDB\Field(type: Type::STRING)]
    private $farmRegion;

    
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
     * Get the value of farmId
     */ 
    public function getFarmId()
    {
        return $this->farmId;
    }

    /**
     * Set the value of farmId
     *
     * @return  self
     */ 
    public function setFarmId($farmId)
    {
        $this->farmId = $farmId;

        return $this;
    }

    /**
     * Get the value of farmName
     */ 
    public function getFarmName()
    {
        return $this->farmName;
    }

    /**
     * Set the value of farmName
     *
     * @return  self
     */ 
    public function setFarmName($farmName)
    {
        $this->farmName = $farmName;

        return $this;
    }

    /**
     * Get the value of farmHouse
     */ 
    public function getFarmHouse()
    {
        return $this->farmHouse;
    }

    /**
     * Set the value of farmHouse
     *
     * @return  self
     */ 
    public function setFarmHouse($farmHouse)
    {
        $this->farmHouse = $farmHouse;

        return $this;
    }

    /**
     * Get the value of farmStreet
     */ 
    public function getFarmStreet()
    {
        return $this->farmStreet;
    }

    /**
     * Set the value of farmStreet
     *
     * @return  self
     */ 
    public function setFarmStreet($farmStreet)
    {
        $this->farmStreet = $farmStreet;

        return $this;
    }

    /**
     * Get the value of farmBarangay
     */ 
    public function getFarmBarangay()
    {
        return $this->farmBarangay;
    }

    /**
     * Set the value of farmBarangay
     *
     * @return  self
     */ 
    public function setFarmBarangay($farmBarangay)
    {
        $this->farmBarangay = $farmBarangay;

        return $this;
    }

    /**
     * Get the value of farmMunicipality
     */ 
    public function getFarmMunicipality()
    {
        return $this->farmMunicipality;
    }

    /**
     * Set the value of farmMunicipality
     *
     * @return  self
     */ 
    public function setFarmMunicipality($farmMunicipality)
    {
        $this->farmMunicipality = $farmMunicipality;

        return $this;
    }

    /**
     * Get the value of farmProvince
     */ 
    public function getFarmProvince()
    {
        return $this->farmProvince;
    }

    /**
     * Set the value of farmProvince
     *
     * @return  self
     */ 
    public function setFarmProvince($farmProvince)
    {
        $this->farmProvince = $farmProvince;

        return $this;
    }

    /**
     * Get the value of farmRegion
     */ 
    public function getFarmRegion()
    {
        return $this->farmRegion;
    }

    /**
     * Set the value of farmRegion
     *
     * @return  self
     */ 
    public function setFarmRegion($farmRegion)
    {
        $this->farmRegion = $farmRegion;

        return $this;
    }
}