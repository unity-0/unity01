<?php

namespace EvenementBundle\Form;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DonType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('montant')
            ->add('cardNum')
            ->add('codeSecurite')
            ->add('nom')
            ->add('email')
            ->add('telephone')
            ->add('evenement',EntityType::class,array('class'=>'EvenementBundle:Evenement','choice_label'=>'id'))
        ->add('ajouter', SubmitType::class);
       ;
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'EvenementBundle\Entity\Don'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'evenementbundle_don';
    }


}
