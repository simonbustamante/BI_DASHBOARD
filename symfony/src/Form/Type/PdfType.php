<?php

namespace App\Form\Type;

use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PdfType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {       
        $builder->add('submit',SubmitType::class,[
            'label' => 'Export PDF',
            'attr' => [
                'class' => 'btn btn-sm btn-outline-secondary',
                'id' => 'pdf-submit',
            ],
        ]);
        $builder->add('farmer_id',HiddenType::class,[
            'mapped' => false,
            'label' => false,
        ]);
        $builder->add('start_invoice_date',HiddenType::class,[ 
            'mapped' => false,
            'label' => false,
        ]);
        $builder->add('end_invoice_date',HiddenType::class,[ 
            'mapped' => false,
            'label' => false,
        ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class'=> FarmerSellDetail::class,
            'data_class'=> null,
        ]);
    }
}


