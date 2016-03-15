<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 15/03/2016
 * Time: 10:48
 */

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RechercherFicheFraisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Visiteur','entity', array(
                'class' => 'GestionFraisBundle:Visiteur',
                'choice_label' => 'username',
            ))
            ->add('date', 'date')
            ->add('save', 'submit')
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_rechercherFicheFrais';
    }
}