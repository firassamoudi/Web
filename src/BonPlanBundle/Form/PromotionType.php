<?php

namespace BonPlanBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;


class PromotionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {$builder
        ->add('description')
        ->add('datedebutp')
        ->add('datefinp',DateType::class, [
            'attr' => ['class' => 'js-datepicker']])



        ->add('urlpromo',FileType::class,array(
            'attr' => array('accept' => 'image/*')))



        ->add('Ajouter', SubmitType::class);
    }



    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_promotion_type';
    }
}
