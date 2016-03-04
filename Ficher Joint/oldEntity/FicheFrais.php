<?php

namespace GestionFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FicheFrais
 *
 * @ORM\Table(name="fiche_frais", indexes={@ORM\Index(name="idEtatFicheFrais", columns={"idEtatFicheFrais"}), @ORM\Index(name="idVisiteur", columns={"idVisiteur"})})
 * @ORM\Entity
 */
class FicheFrais
{
    /**
     * @var string
     *
     * @ORM\Column(name="mois", type="string", length=6, nullable=false)
     */
    private $mois;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="date", nullable=false)
     */
    private $datemodif;

    /**
     * @var float
     *
     * @ORM\Column(name="montantValide", type="float", precision=10, scale=0, nullable=false)
     */
    private $montantvalide;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \GestionFraisBundle\Entity\Visiteur
     *
     * @ORM\ManyToOne(targetEntity="GestionFraisBundle\Entity\Visiteur")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idVisiteur", referencedColumnName="id")
     * })
     */
    private $idvisiteur;

    /**
     * @var \GestionFraisBundle\Entity\EtatFicheFrais
     *
     * @ORM\ManyToOne(targetEntity="GestionFraisBundle\Entity\EtatFicheFrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEtatFicheFrais", referencedColumnName="id")
     * })
     */
    private $idetatfichefrais;



    /**
     * Set mois
     *
     * @param string $mois
     *
     * @return FicheFrais
     */
    public function setMois($mois)
    {
        $this->mois = $mois;
    
        return $this;
    }

    /**
     * Get mois
     *
     * @return string
     */
    public function getMois()
    {
        return $this->mois;
    }

    /**
     * Set datemodif
     *
     * @param \DateTime $datemodif
     *
     * @return FicheFrais
     */
    public function setDatemodif($datemodif)
    {
        $this->datemodif = $datemodif;
    
        return $this;
    }

    /**
     * Get datemodif
     *
     * @return \DateTime
     */
    public function getDatemodif()
    {
        return $this->datemodif;
    }

    /**
     * Set montantvalide
     *
     * @param float $montantvalide
     *
     * @return FicheFrais
     */
    public function setMontantvalide($montantvalide)
    {
        $this->montantvalide = $montantvalide;
    
        return $this;
    }

    /**
     * Get montantvalide
     *
     * @return float
     */
    public function getMontantvalide()
    {
        return $this->montantvalide;
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
     * Set idvisiteur
     *
     * @param \GestionFraisBundle\Entity\Visiteur $idvisiteur
     *
     * @return FicheFrais
     */
    public function setIdvisiteur(\GestionFraisBundle\Entity\Visiteur $idvisiteur = null)
    {
        $this->idvisiteur = $idvisiteur;
    
        return $this;
    }

    /**
     * Get idvisiteur
     *
     * @return \GestionFraisBundle\Entity\Visiteur
     */
    public function getIdvisiteur()
    {
        return $this->idvisiteur;
    }

    /**
     * Set idetatfichefrais
     *
     * @param \GestionFraisBundle\Entity\EtatFicheFrais $idetatfichefrais
     *
     * @return FicheFrais
     */
    public function setIdetatfichefrais(\GestionFraisBundle\Entity\EtatFicheFrais $idetatfichefrais = null)
    {
        $this->idetatfichefrais = $idetatfichefrais;
    
        return $this;
    }

    /**
     * Get idetatfichefrais
     *
     * @return \GestionFraisBundle\Entity\EtatFicheFrais
     */
    public function getIdetatfichefrais()
    {
        return $this->idetatfichefrais;
    }
    /**
     * (Add this method into your class)
     *
     * @return string String representation of this class
     */
    public function __toString()
    {
        return $this->mois;
    }
}
