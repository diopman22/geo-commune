<?php

namespace UtilisateursBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('dateNaiss', BirthdayType::class)
            ->add('lieuNaiss',TextType::class)
            ->add('username',EmailType::class)
            ->add('password',PasswordType::class)
            ->add('profil',ChoiceType::class,array('choices'=>array('-- Sélectionner le rôle --'=>NULL,'Modérateur'=>"ROLE_MODERATEUR",
                            'Propriétaire'=>"ROLE_PROPRIETAIRE",'Représentant Commission Domaniale'=>"ROLE_COMMISSION")))
            ->add('Valider',SubmitType::class)
        ;
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'UtilisateursBundle\Entity\User'
        ));
    }
}
