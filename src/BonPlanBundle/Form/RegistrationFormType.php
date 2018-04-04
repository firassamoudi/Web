<?php

namespace BonPlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('roles',ChoiceType::class,array(
            'label'=>'Role',
            'choices'=>array(
                'Proprietaire'=>'ROLE_PROP',
                'visiteur'=>'ROLE_VISITEUR',

            ),
            'required'=>true,
            'multiple'=>true))
            ->add('photodeprofil',FileType::class,array(
                'required' => false


            ));

    }
    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType' ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_registration_form_type';
    }
}
