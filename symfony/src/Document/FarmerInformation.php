<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type;

#[MongoDB\Document(db: "farmers", collection: "farmer_information")]
class FarmerInformation
{
    #[MongoDB\Id]
    private string $id;

    #[MongoDB\Field(type: Type::STRING)]
    private string $farmerId;

    #[MongoDB\Field(type: Type::STRING)]
    private $name;

    #[MongoDB\Field(type: Type::STRING)]
    private $middle;

    #[MongoDB\Field(type: Type::STRING)]
    private $surname; 

    #[MongoDB\Field(type: Type::STRING)]
    private $sex; 

    #[MongoDB\Field(type: Type::STRING)]
    private $address; 

    #[MongoDB\Field(type: Type::STRING)]
    private $contact; 

    #[MongoDB\Field(type: Type::STRING)]
    private $birthday; 

    #[MongoDB\Field(type: Type::STRING)]
    private $birthplace; 

    #[MongoDB\Field(type: Type::STRING)]
    private $birthcontry; 

    #[MongoDB\Field(type: Type::STRING)]
    private $religion; 

    #[MongoDB\Field(type: Type::STRING)]
    private $civilstatus; 

    #[MongoDB\Field(type: Type::STRING)]
    private $spouse; 

    #[MongoDB\Field(type: Type::STRING)]
    private $education; 

    #[MongoDB\Field(type: Type::STRING)]
    private $governmentid;
    

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
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of middle
     */ 
    public function getMiddle()
    {
        return $this->middle;
    }

    /**
     * Set the value of middle
     *
     * @return  self
     */ 
    public function setMiddle($middle)
    {
        $this->middle = $middle;

        return $this;
    }

    /**
     * Get the value of surname
     */ 
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set the value of surname
     *
     * @return  self
     */ 
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get the value of sex
     */ 
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Set the value of sex
     *
     * @return  self
     */ 
    public function setSex($sex)
    {
        $this->sex = $sex;

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get the value of contact
     */ 
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set the value of contact
     *
     * @return  self
     */ 
    public function setContact($contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get the value of birthday
     */ 
    public function getBirthday()
    {
        return $this->birthday;
    }

    /**
     * Set the value of birthday
     *
     * @return  self
     */ 
    public function setBirthday($birthday)
    {
        $this->birthday = $birthday;

        return $this;
    }

    /**
     * Get the value of birthplace
     */ 
    public function getBirthplace()
    {
        return $this->birthplace;
    }

    /**
     * Set the value of birthplace
     *
     * @return  self
     */ 
    public function setBirthplace($birthplace)
    {
        $this->birthplace = $birthplace;

        return $this;
    }

    /**
     * Get the value of birthcontry
     */ 
    public function getBirthcontry()
    {
        return $this->birthcontry;
    }

    /**
     * Set the value of birthcontry
     *
     * @return  self
     */ 
    public function setBirthcontry($birthcontry)
    {
        $this->birthcontry = $birthcontry;

        return $this;
    }

    /**
     * Get the value of religion
     */ 
    public function getReligion()
    {
        return $this->religion;
    }

    /**
     * Set the value of religion
     *
     * @return  self
     */ 
    public function setReligion($religion)
    {
        $this->religion = $religion;

        return $this;
    }

    /**
     * Get the value of civilstatus
     */ 
    public function getCivilstatus()
    {
        return $this->civilstatus;
    }

    /**
     * Set the value of civilstatus
     *
     * @return  self
     */ 
    public function setCivilstatus($civilstatus)
    {
        $this->civilstatus = $civilstatus;

        return $this;
    }

    /**
     * Get the value of spouse
     */ 
    public function getSpouse()
    {
        return $this->spouse;
    }

    /**
     * Set the value of spouse
     *
     * @return  self
     */ 
    public function setSpouse($spouse)
    {
        $this->spouse = $spouse;

        return $this;
    }

    /**
     * Get the value of education
     */ 
    public function getEducation()
    {
        return $this->education;
    }

    /**
     * Set the value of education
     *
     * @return  self
     */ 
    public function setEducation($education)
    {
        $this->education = $education;

        return $this;
    }

    /**
     * Get the value of governmentid
     */ 
    public function getGovernmentid()
    {
        return $this->governmentid;
    }

    /**
     * Set the value of governmentid
     *
     * @return  self
     */ 
    public function setGovernmentid($governmentid)
    {
        $this->governmentid = $governmentid;

        return $this;
    }
}