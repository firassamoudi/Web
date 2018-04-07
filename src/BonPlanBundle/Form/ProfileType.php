<?php

namespace BonPlanBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder->add('telephone')
            ->add('nomPlan')
            ->add('adresse')
            ->add('description', TextareaType::class, array(
        'attr' => array('class' => 'tinymce'),))
            ->add('categorie',EntityType::class,array(
                'class' => 'BonPlanBundle:Categorie',
                'choice_label' => 'nomCategorie',
                'multiple' => false,
            ))
            ->add('file',FileType::class , array(
                'attr' => array('accept' => 'image/*')))
            ->add('Ajouter', SubmitType::class);
        }





    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_profile_type';
    }
}
