<?php

namespace App\Form\Model;

use App\Document\FarmerSellDetail;
use Symfony\Component\Validator\Constraints as Assert;

class Search
{
    #[Assert\NotBlank]
    #[Assert\Type(FarmerSellDetail::class)]
    protected $sellDetail = [
        'farmer_id' => '',
        'invoice_date' => '',
    ];

    /**
     * Get the value of sellDetail
     */ 
    public function getSellDetail()
    {
        return $this->sellDetail;
    }

    /**
     * Set the value of sellDetail
     *
     * @return  self
     */ 
    public function setSellDetail($key,$value)
    {
        $this->sellDetail[$key] = $value;

        return $this;
    }

    public function __toString()
    {
        return $this->sellDetail;
    }
}