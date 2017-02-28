<?php

namespace MapBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OverlayType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('infos',TextareaType::class)
            ->add('type',ChoiceType::class,array('choices'=>array('-- Sélectionner l\'action --'=>NULL,
                        'Parcelle'=>"Parcelle",'Marqueur'=>"Marqueur")))
            ->add('lat',TextType::class)
            ->add('lng',TextType::class)
            ->add('user',EntityType::class,array(
                    'class' => 'UtilisateursBundle:User',
                    'choice_label' => 'username'
            ))
            ->add('Enregistrer',SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'MapBundle\Entity\Overlay'
        ));
    }
}
