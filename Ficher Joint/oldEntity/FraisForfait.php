<?php

namespace GestionFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FraisForfait
 *
 * @ORM\Table(name="frais_forfait")
 * @ORM\Entity
 */
class FraisForfait
{
    /**
     * @var string
     *
     * @ORM\Column(name="libelleFraisForfait", type="string", length=255, nullable=false)
     */
    private $libellefraisforfait;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set libellefraisforfait
     *
     * @param string $libellefraisforfait
     *
     * @return FraisForfait
     */
    public function setLibellefraisforfait($libellefraisforfait)
    {
        $this->libellefraisforfait = $libellefraisforfait;
    
        return $this;
    }

    /**
     * Get libellefraisforfait
     *
     * @return string
     */
    public function getLibellefraisforfait()
    {
        return $this->libellefraisforfait;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return FraisForfait
     */
    public function setMontant($montant)
    {
        $this->montant = $montant;
    
        return $this;
    }

    /**
     * Get montant
     *
     * @return float
     */
    public function getMontant()
    {
        return $this->montant;
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
}
