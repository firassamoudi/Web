<?php

namespace BonPlanBundle\Form;

use Doctrine\DBAL\Types\TextType;
<<<<<<< HEAD
use Ivory\CKEditorBundle\Form\Type\CKEditorType;
=======
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AjouterCommentaire extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
<<<<<<< HEAD
        $builder->add('commentaire',CKEditorType::class, array(
            'config' => array(
                'uiColor' => '#ffffff',
                //...
            ),
        ));
=======
        $builder->add('commentaire',TextareaType::class);
>>>>>>> 1c4d0f271342a3deebb8766ad8e9dbb8d20e4b6e
    }

    public function configureOptions(OptionsResolver $resolver)
    {

    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_ajouter_commentaire';
    }
}
