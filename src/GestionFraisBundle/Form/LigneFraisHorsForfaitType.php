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
            if($options['action'] == 'ajouter')
            {
                $builder
                    ->add('date', 'date')
                    ->add('montant', 'money')
                    ->add('libellelignehorsforfait', 'textarea')
                    ->add('file', 'file', array('label' => 'Justificatif', 'required' => false));
            }
            elseif($options['action'] == 'modifier')
            {
                $builder
                    ->add('date', 'date')
                    ->add('montant', 'money')
                    ->add('libellelignehorsforfait', 'textarea')
                    ->add('file', 'file', array('label' => 'Justificatif', 'required' => false));

            }
        }
        elseif($options['role'] == 'comptable')
        {
            if($options['action']=='valider') {
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
            'data_class' => 'GestionFraisBundle\Entity\LigneFraisHorsForfait'
        ));
        $resolver->setDefaults(array(
            'role' => 'utilisateur',
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
