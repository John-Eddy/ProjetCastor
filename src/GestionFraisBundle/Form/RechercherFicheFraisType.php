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
use Symfony\Component\OptionsResolver\OptionsResolver;

class RechercherFicheFraisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $annee = array();
        for($i = date('Y'); $i>date('Y') - 5; $i-- )
        {
            $annee += array(strval($i) => strval($i)) ;
        }
        $mois = array(
            '01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril', '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet',
            '08' => 'Aout', '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Decembre'
        );


        if ($options['role'] == 'comptable') {
            $builder
                ->add('utilisateur', 'entity', array(
                    'class' => 'GestionFraisBundle:Visiteur',
                    'choice_label' => 'username',
                    'required' => false,
                    'placeholder' => 'Utilisateur',
                    'empty_data' => null,
                    'label'=>' '
                ));
        }
        $builder

            ->add('mois', 'choice', array(
                'choices' => $mois,
                'required' => false,
                'placeholder' => 'Mois',
                'empty_data' => null,
                'label'=>" "
            ))
            ->add('annee', 'choice', array(
                'choices' => $annee,
                'required' => false,
                'placeholder' => 'Année',
                'empty_data' => null,
                'label'=>' '
            ))
        ->add('Rechercher', 'submit');;

    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_rechercherFicheFrais';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'role' => 'utilisateur',
        ));
    }
}