<?php

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LigneFraisHorsForfaitType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        if ($options['operation'] == 'consulter')
        {
            $builder
                ->add('date', 'date', array('disabled' => true))
                ->add('montant', 'money', array('disabled' => true))
                ->add('libellelignehorsforfait', 'textarea', array(
                    'label'=>'Libelle',
                    'disabled' => true
                ))
                ->add('idetatlignefrais', 'entity', array(
                    'class' => 'GestionFraisBundle:EtatLigneFrais',
                    'choice_label' => 'libelleetatlignefrais',
                    'disabled' => true,
                    'label' => 'Etat'
                ));
        }
        else if ($options['role'] == 'utilisateur') {
            $builder
                ->add('date', 'date')
                ->add('montant', 'money')
                ->add('libellelignehorsforfait', 'textarea', array('label'=>'Libelle'))
                ->add('idetatlignefrais', 'entity', array(
                    'class' => 'GestionFraisBundle:EtatLigneFrais',
                    'choice_label' => 'libelleetatlignefrais',
                    'disabled' => true,
                    'label' => 'Etat'
                ))
                ->add('Enregistrer', 'submit');
        ;
        }
        elseif($options['role'] == 'comptable') {
            $builder
                ->add('date', 'date', array('disabled' => true))
                ->add('montant', 'money', array('disabled' => true))
                ->add('libellelignehorsforfait', 'textarea',array(
                    'disabled' => true,
                    'label'=>'Libelle'
                    ))
                ->add('idetatlignefrais', 'entity', array(
                    'class' => 'GestionFraisBundle:EtatLigneFrais',
                    'choice_label' => 'libelleetatlignefrais',
                    'label' => 'Etat'
                ))
                ->add('Enregistrer', 'submit');
            ;
        }


    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionFraisBundle\Entity\LigneFraisHorsForfait',
            'role' => null,
            'operation' =>'modifier'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_lignefraishorsforfait';
    }


}
