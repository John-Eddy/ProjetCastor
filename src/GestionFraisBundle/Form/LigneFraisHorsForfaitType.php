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
        if ($options['role'] == 'utilisateur')
        {
            if($options['operation'] == 'ajouter')
            {
                $builder
                    ->add('date', 'date')
                    ->add('montant', 'money')
                    ->add('libellelignehorsforfait', 'textarea')
                    ->add('idetatlignefrais', 'entity', array(
                        'class' => 'GestionFraisBundle:EtatLigneFrais',
                        'choice_label' => 'libelleetatlignefrais',
                        'disabled' => true,
                        'label' => 'Etat'
                    ))
                    ->add('file', 'file', array('label' => 'Justificatif', 'required' => false));
            }
            elseif($options['operation'] == 'modifier')
            {
                $builder
                    ->add('date', 'date')
                    ->add('montant', 'money')
                    ->add('libellelignehorsforfait', 'textarea')
                    ->add('idetatlignefrais', 'entity', array(
                        'class' => 'GestionFraisBundle:EtatLigneFrais',
                        'choice_label' => 'libelleetatlignefrais',
                        'disabled' => true,
                        'label' => 'Etat'
                    ))
                    ->add('file', 'file', array('label' => 'Justificatif', 'required' => false));

            }
        }
        elseif($options['role'] == 'comptable')
        {
            if($options['operation']=='valider') {
                $i=0;
            }
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
            'data_class' => 'GestionFraisBundle\Entity\LigneFraisHorsForfait',
            'role' => null,
            'operation' =>'consulter'
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
