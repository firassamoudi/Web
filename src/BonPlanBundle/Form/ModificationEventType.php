<?php
/**
 * Created by PhpStorm.
 * User: meyss
 * Date: 11/04/2018
 * Time: 08:52
 */

namespace BonPlanBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModificationEventType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nomev')
            ->add('description')
            ->add('nbrplace')
            ->add('datedebutev')
            ->add('datefinev')
            ->add('Modifier', SubmitType::class);

    }/**
 * {@inheritdoc}
 */
    public function configureOptions(OptionsResolver $resolver)
    {

            }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'bonplanbundle_events';
    }


}