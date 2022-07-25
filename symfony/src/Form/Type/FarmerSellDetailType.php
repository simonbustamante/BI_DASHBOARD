<?php

namespace App\Form\Type;

use App\Document\FarmerSellDetail;
use App\Document\FarmerInformation;
use Doctrine\ODM\MongoDB\DocumentManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FarmerSellDetailType extends AbstractType
{
    private $farmerInformation;
    private $farmer = ['Please select a farmer' => 'all'];
    public function __construct(DocumentManager $dm)
    {
        $this->farmerInformation = $dm->getDocumentCollection(FarmerInformation::class)->find();
        $i = 1;
        foreach($this->farmerInformation as $fi)
        {
            $this->farmer[$fi['name']." ".$fi['surname']] = $fi['farmerId'];
        }
        //dump($this->farmer);
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {       
        $builder->add('farmer_id',ChoiceType::class,[
            'choices' => $this->farmer,
            'mapped' => false,
            'label' => false,
            'attr' => [
                'class' => 'btn btn-sm btn-outline-secondary',
            ],
        ]);
        $builder->add('start_invoice_date',DateType::class,[
            'widget' => 'single_text', 
            'mapped' => false,
            'label' => false,
            'attr' => [
                'class' => 'btn btn-sm btn-outline-secondary',
            ],
        ]);
        $builder->add('end_invoice_date',DateType::class,[
            'widget' => 'single_text', 
            'mapped' => false,
            'label' => false,
            'attr' => [
                'class' => 'btn btn-sm btn-outline-secondary',
            ],
        ]);
        // $builder->add('report_type',ChoiceType::class,[
        //     'choices' => [
        //         'Report Line' => 'TYPE_LINE',
        //         'Report Bar' => 'TYPE_BAR',
        //         'Bubble' => 'TYPE_BUBBLE',
        //         'Doughnut' => 'TYPE_DOUGHNUT',
        //         'Pie' => 'TYPE_PIE',
        //         'Polar' => 'TYPE_POLAR_AREA',
        //         'Radar' => 'TYPE_RADAR',
        //         'Scatter' => 'TYPE_SCATTER'
        //     ],
        //     'mapped' => false,
        //     'label' => false,
        //     'attr' => [
        //         'class' => 'btn btn-sm btn-outline-secondary',
        //     ]
        // ]);
        // $builder->add('submit',SubmitType::class,[ 
        //     'attr' => [
        //         'class' => 'btn btn-sm btn-outline-secondary',
        //     ],
        // ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            //'data_class'=> FarmerSellDetail::class,
            'data_class'=> null,
        ]);
    }
}


