<?php

namespace GestionFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneFraisForfait
 *
 * @ORM\Table(name="ligne_frais_forfait", indexes={@ORM\Index(name="idVisiteur", columns={"idFraisForfait"}), @ORM\Index(name="idEtatLigneFrais", columns={"idEtatLigneFrais"}), @ORM\Index(name="idFraisForfait", columns={"idFraisForfait"}), @ORM\Index(name="idFiche", columns={"idFicheFrais"})})
 * @ORM\Entity
 */
class LigneFraisForfait
{
    /**
     * @var float
     *
     * @ORM\Column(name="quantite", type="float", precision=10, scale=0, nullable=false)
     */
    private $quantite;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \GestionFraisBundle\Entity\FicheFrais
     *
     * @ORM\ManyToOne(targetEntity="GestionFraisBundle\Entity\FicheFrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFicheFrais", referencedColumnName="id")
     * })
     */
    private $idfichefrais;

    /**
     * @var \GestionFraisBundle\Entity\EtatLigneFrais
     *
     * @ORM\ManyToOne(targetEntity="GestionFraisBundle\Entity\EtatLigneFrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEtatLigneFrais", referencedColumnName="id")
     * })
     */
    private $idetatlignefrais;

    /**
     * @var \GestionFraisBundle\Entity\FraisForfait
     *
     * @ORM\ManyToOne(targetEntity="GestionFraisBundle\Entity\FraisForfait")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idFraisForfait", referencedColumnName="id")
     * })
     */
    private $idfraisforfait;



    /**
     * Set quantite
     *
     * @param float $quantite
     *
     * @return LigneFraisForfait
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;
    
        return $this;
    }

    /**
     * Get quantite
     *
     * @return float
     */
    public function getQuantite()
    {
        return $this->quantite;
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
     * Set idfichefrais
     *
     * @param \GestionFraisBundle\Entity\FicheFrais $idfichefrais
     *
     * @return LigneFraisForfait
     */
    public function setIdfichefrais(\GestionFraisBundle\Entity\FicheFrais $idfichefrais = null)
    {
        $this->idfichefrais = $idfichefrais;
    
        return $this;
    }

    /**
     * Get idfichefrais
     *
     * @return \GestionFraisBundle\Entity\FicheFrais
     */
    public function getIdfichefrais()
    {
        return $this->idfichefrais;
    }

    /**
     * Set idetatlignefrais
     *
     * @param \GestionFraisBundle\Entity\EtatLigneFrais $idetatlignefrais
     *
     * @return LigneFraisForfait
     */
    public function setIdetatlignefrais(\GestionFraisBundle\Entity\EtatLigneFrais $idetatlignefrais = null)
    {
        $this->idetatlignefrais = $idetatlignefrais;
    
        return $this;
    }

    /**
     * Get idetatlignefrais
     *
     * @return \GestionFraisBundle\Entity\EtatLigneFrais
     */
    public function getIdetatlignefrais()
    {
        return $this->idetatlignefrais;
    }

    /**
     * Set idfraisforfait
     *
     * @param \GestionFraisBundle\Entity\FraisForfait $idfraisforfait
     *
     * @return LigneFraisForfait
     */
    public function setIdfraisforfait(\GestionFraisBundle\Entity\FraisForfait $idfraisforfait = null)
    {
        $this->idfraisforfait = $idfraisforfait;
    
        return $this;
    }

    /**
     * Get idfraisforfait
     *
     * @return \GestionFraisBundle\Entity\FraisForfait
     */
    public function getIdfraisforfait()
    {
        return $this->idfraisforfait;
    }
}
