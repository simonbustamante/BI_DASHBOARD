<?php

namespace App\Document;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_profile")]
class FarmerProfile
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;


    // #[MongoDB\ReferenceMany(targetDocument: "FarmerInformation", mappedBy: "FarmerProfile", orphanRemoval: true)]
    // private string $farmerInformation;

    public function __construct()
    {
        $this->farmerInformation = new ArrayCollection();
    }

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

    // /**
    //  * @return Collection|FarmerInformation[]
    //  */
    // public function getFarmerInformation()
    // {
    //     return $this->farmerInformation;
    // }

    // /**
    //  * Set the value of farmerInformation
    //  *
    //  * @return  self
    //  */ 
    // public function addFarmerInformation(FarmerInformation $farmerInformation)
    // {
    //     $this->farmerInformation[] = $farmerInformation;

    //     return $this;
    // }

    // public function removeFarmerInformation(FarmerInformation $farmerInformation): void
    // {
    //     unset($this->farmerInformation[$farmerInformation]);   
    // }
}