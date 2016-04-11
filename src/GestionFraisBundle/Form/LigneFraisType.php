<?php

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LigneFraisType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
       /* if ($options['type'] == 'fraisforfait')
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
                        'class' => 'GestionFraisBundle:FraisForfait',
                        'choice_label' => 'libellefraisforfait',
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
        else{
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

        }*/

        if ($options['type'] == 'fraisforfait'){
            $builder->add(new LigneFraisForfaitType(),$options['ligne'],$options);
        }
        else
        {
            $builder->add(new LigneFraisHorsForfaitType(),$options['ligne'],$options);
        }

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => null,
            'role' => null,
            'operation' =>'modifier',
            'type' => null,
            'ligne'=>null
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_lignefrais';
    }


}
