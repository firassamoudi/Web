<?php

namespace BonPlanBundle\Form;

use Doctrine\DBAL\Types\DateType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PromotionUpdateType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('description')


            ->add('datedebutp' )
            ->add('datefinp' )
    ->add('reduction')
<<<<<<< HEAD
            ->add('etat',ChoiceType::class,array(
                'label'=>'Etat',
                'choices'=>array(
                    'en cours'=>'en cours',
                    'annulee'=>'annulee',

                ),
                'required'=>true,
                'multiple'=>true))
        ;
=======

>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e

            ;

    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_promotion_update_type';
    }
}
