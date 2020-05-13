<?php

namespace AnnonceBundle\Form;

use blackknight467\StarRatingBundle\Form\RatingType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichFileType;

class AnnonceType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')->add('description',CKEditorType::class,array(

            'config' => array(
                'uiColor' => '#0B3B0B',
                'required'=>true,


            ),))
            ->add('date')->add('Ajouter',SubmitType::class)
            ->add('commentaire',EntityType::class,array('class'=>'AnnonceBundle:Commentaire','choice_label'=>'contenu','multiple'=>false))
            ->add('annoncephoto', VichFileType::class, [
                'required' => false,
                'allow_delete' => true,
                'download_link' => true
            ]);
    }/**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'AnnonceBundle\Entity\Annonce'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'annoncebundle_annonce';
    }


}
