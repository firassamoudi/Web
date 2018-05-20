<?php

namespace BonPlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UpdateCateg extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
<<<<<<< HEAD
        $builder->add('nomCategorie')
                ->add('file',FileType::class , array(
                    'attr' => array('accept' => 'image/*')));
=======
        $builder->add('nomCategorie');
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_update_categ';
    }
}
