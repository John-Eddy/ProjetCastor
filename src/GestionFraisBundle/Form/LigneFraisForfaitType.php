<?php

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LigneFraisForfaitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['operation'] == 'consulter')
        {
            $builder
                ->add('date', 'date', array('disabled' => true))
                ->add('idfraisforfait', 'entity', array(
                    'class' => 'GestionFraisBundle:FraisForfait',
                    'choice_label' => 'libellefraisforfait',
                    'disabled' => true,
                    'label' => 'Type de Frais'
                ))
                ->add('quantite', 'text', array('disabled' => true,))
                ->add('montant', 'text', array('disabled' => true))
                ->add('idetatlignefrais', 'entity', array(
                    'class' => 'GestionFraisBundle:EtatLigneFrais',
                    'choice_label' => 'libelleetatlignefrais',
                    'placeholder' => 'Etat',
                    'label' => 'Etat',
                    'disabled' => true,
                ));
        }
        else if ($options['role'] == 'utilisateur')
        {
            $builder
                ->add('date', 'date')
                ->add('idetatlignefrais', 'entity', array(
                    'class' => 'GestionFraisBundle:EtatLigneFrais',
                    'choice_label' => 'libelleetatlignefrais',
                    'disabled' => true,
                    'label' => 'Etat'
                ))
                ->add('idfraisforfait', 'entity', array(
                    'class' => 'GestionFraisBundle:FraisForfait',    'choice_label' => 'libellefraisforfait',
                    'required' => true,
                    'placeholder' => 'Type de Frais',
                    'empty_data' => null,
                    'label' => 'Type de Frais'
                ))
                ->add('quantite', 'number')
                ->add('montant', 'text', array('disabled' => true))
                ->add('Enregistrer', 'submit');
            ;
        }
        elseif($options['role'] == 'comptable') {

            $builder

                ->add('date', 'date', array('disabled' => true))
                ->add('idfraisforfait', 'entity', array(
                    'class' => 'GestionFraisBundle:FraisForfait',
                    'choice_label' => 'libellefraisforfait',
                    'disabled' => true,
                    'label' => 'Type de Frais'
                ))
                ->add('quantite', 'text', array('disabled' => true,))
                ->add('montant', 'text', array('disabled' => true))
                ->add('idetatlignefrais', 'entity', array(
                    'class' => 'GestionFraisBundle:EtatLigneFrais',
                    'choice_label' => 'libelleetatlignefrais',
                    'placeholder' => 'Etat',
                    'label' => 'Etat',
                    'required' => true
                ))
                ->add('Enregistrer', 'submit');
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionFraisBundle\Entity\LigneFraisForfait',
            'role' => null,
            'operation' =>'consulter'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_lignefraisforfait';
    }
}
