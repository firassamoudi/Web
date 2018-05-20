<?php

namespace BonPlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RatePromoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('etat_promo',ChoiceType::class,array(
            'label'=>'note',
            'choices'=>array(
                '1'=>1,
                '2'=>2,
                '3'=>3,
                '4'=>4,
                '5'=>5,
                '6'=>6,
                '7'=>7,
                '8'=>8,
                '9'=>9,
                '10'=>10,),))


            ->add('Noter',SubmitType::class);}

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_rate_form';
    }
}
