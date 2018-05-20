<?php
/**
 * Created by PhpStorm.
 * User: meyss
 * Date: 11/04/2018
 * Time: 08:23
 */

namespace BonPlanBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnnulationEventType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Annuler', SubmitType::class);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
    }

    public function getBlockPrefix()
    {
        return 'bon_plan_bundle_Annuler_event';
    }
}

    {

}