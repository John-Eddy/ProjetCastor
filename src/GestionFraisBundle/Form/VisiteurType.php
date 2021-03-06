<?php

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class VisiteurType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['role'] == 'administrateur') {
            $builder
                ->add('nom')
                ->add('prenom');

        }
        if($options['operation']=='ajouter')
        {
            $builder
                ->add('username','text',array('required'=>true))
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
                ))
                ->add('enabled','choice',
                    array(
                        'label' => 'Etat',
                    'choices'  => array(
                        1 => 'Activé',
                        0 => 'Désactivé'
                )))
                ->add('roles', 'collection', array(
                'label' => 'Type visiteur',
                'required' => true,
                'type' => 'choice',
                'options' => array(
                    'label' => false,
                    'choices' => array(
                        'ROLE_UTILISATEUR' => 'Utilisateur',
                        'ROLE_COMPTABLE' => 'Comptable',
                        'ROLE_ADMIN' => 'Administrateur'
                    )
                )
            )
        );
        }
        if($options['operation'] == 'changerCoordonnee' || $options['role'] == 'administrateur')
        {
            $builder
                ->add('adresse')
                ->add('ville')
                ->add('cp')
                ->add('email', 'email', array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'));
        }
        if($options['operation'] == 'changerMdp')
        {
            $builder
                ->add('mdp',new ChangerMotDePasseType())
                ->add('plainPassword', 'repeated', array(
                    'type' => 'password',
                    'label' => 'Nouveau mot de passe',
                    'options' => array('translation_domain' => 'FOSUserBundle'),
                    'first_options' => array('label' => 'form.password'),
                    'second_options' => array('label' => 'form.password_confirmation'),
                    'invalid_message' => 'fos_user.password.mismatch',
                ));

        }


        $builder
            ->add('Enregistrer', 'submit');
        ;


    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionFraisBundle\Entity\Visiteur',
            'operation' => null,
            'role' => null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_visiteur';
    }
}
