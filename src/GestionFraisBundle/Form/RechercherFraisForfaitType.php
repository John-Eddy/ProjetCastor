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

class RechercherFraisForfaitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $builder
            ->add('FraisForfait', 'entity', array(
                'class' => 'GestionFraisBundle:FraisForfait',
                'choice_label' => 'libellefraisforfait',
                'required' => true,
                'placeholder' => 'Frais Forfait',
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
        return 'gestionfraisbundle_rechercherFraisForfait';
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'operation' => null,
        ));
    }
}