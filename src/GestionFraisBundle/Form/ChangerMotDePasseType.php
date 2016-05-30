<?php

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ChangerMotDePasseType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder

             ->add('mdp','password',array(
                 'label'=>'Mot de passe'
             ))
             ->add('plainPassword', 'repeated', array(
                 'type' => 'password',
                 'label' => 'Nouveau mot de passe',
                 'options' => array('translation_domain' => 'FOSUserBundle'),
                 'first_options' => array('label' => 'form.password'),
                 'second_options' => array('label' => 'form.password_confirmation'),
                 'invalid_message' => 'fos_user.password.mismatch',
             ))
            ->add('Enregistrer', 'submit');



        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_ChangerMotDePasse';
    }
}
