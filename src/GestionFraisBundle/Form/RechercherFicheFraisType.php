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
        if ($options['type'] == 'comptable') {
            $builder
                ->add('Visiteur', 'entity', array(
                    'class' => 'GestionFraisBundle:Visiteur',
                    'choice_label' => 'username',
                    'required' => false,
                    'placeholder' => 'Tous',
                    'empty_data' => null
                ));
        }
        $builder
            //->add('test', new EtatLigneFraisType())
            ->add('mois', 'date',
                array(
                    'format' => 'yyyy-MM-dd',
                    'years' => range(date('Y'), date('Y') - 5),
                    'days' => array(1),
                    'empty_value' => array('year' => 'Année', 'month' => 'Mois', 'day' => '----'),
                    'required' => false,
                )
            );

        $builder
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
            'type' => 'utilisateur',
        ));
    }
}