<?php

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FraisForfaitType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if($options['role'] == 'utilisateur')
        {
            $builder
                ->add('TypeFrais','choice',
                    array(
                        'choice_label'=>'libellefraisforfait',
                        'placeholder'=>'Type de frais',
                        'required'=>'true'
                    ))
            ;
        }

    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionFraisBundle\Entity\FraisForfait'
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
        return 'gestionfraisbundle_fraisforfait';
    }
}