<?php

namespace GestionFraisBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class FicheFraisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mois')
            ->add('datemodif')
            ->add('montantvalide')
            ->add('idvisiteur')
            ->add('idetatfichefrais')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'GestionFraisBundle\Entity\FicheFrais'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'gestionfraisbundle_fichefrais';
    }
}
