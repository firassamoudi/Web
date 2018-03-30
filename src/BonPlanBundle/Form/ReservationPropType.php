<?php

namespace BonPlanBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ReservationPropType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder  ->add('etat',ChoiceType::class, array(
            'choices' => array(
                'en cours' => 'en cours',
                'annulé' => 'annulé',
                'accepté' => 'accepté',
            )))->
        add('description', TextareaType::class, array(
            'attr' => array('class' => 'tinymce')))

            ->add('Traiter',SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'BonPlanBundle\Entity\Reservation'
        ));
    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_reservation_prop_type';
    }
}
