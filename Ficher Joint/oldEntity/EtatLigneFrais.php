<?php

namespace GestionFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EtatLigneFrais
 *
 * @ORM\Table(name="etat_ligne_frais")
 * @ORM\Entity
 */
class EtatLigneFrais
{
    /**
     * @var string
     *
     * @ORM\Column(name="libelleEtatLigneFrais", type="string", length=255, nullable=false)
     */
    private $libelleetatlignefrais;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set libelleetatlignefrais
     *
     * @param string $libelleetatlignefrais
     *
     * @return EtatLigneFrais
     */
    public function setLibelleetatlignefrais($libelleetatlignefrais)
    {
        $this->libelleetatlignefrais = $libelleetatlignefrais;
    
        return $this;
    }

    /**
     * Get libelleetatlignefrais
     *
     * @return string
     */
    public function getLibelleetatlignefrais()
    {
        return $this->libelleetatlignefrais;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    /**
     * (Add this method into your class)
     *
     * @return string String representation of this class
     */
    public function __toString()
    {
        return $this->libelleetatlignefrais;
    }
}
