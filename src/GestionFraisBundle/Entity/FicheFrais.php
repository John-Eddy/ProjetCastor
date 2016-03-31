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
     * @ORM\Column(name="mois", type="string", length=2, nullable=false)
     */
    private $mois;

    /**
     * @var string
     *
     * @ORM\Column(name="annee", type="string", length=4, nullable=false)
     */
    private $annee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCreation", type="datetime", nullable=false)
     */
    private $datecreation;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateModif", type="datetime", nullable=false)
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
     * @var \GestionFraisBundle\Entity\EtatFicheFrais
     *
     * @ORM\ManyToOne(targetEntity="GestionFraisBundle\Entity\EtatFicheFrais")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="idEtatFicheFrais", referencedColumnName="id")
     * })
     */
    private $idetatfichefrais;


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
     * @ORM\OneToMany(targetEntity="GestionFraisBundle\Entity\LigneFraisForfait", mappedBy="idfichefrais")
     */
    private $lignesFraisForfaits;

    /**
     * @ORM\OneToMany(targetEntity="GestionFraisBundle\Entity\LigneFraisHorsForfait", mappedBy="idfichefrais")
     */
    private $lignesFraisHorsForfaits;

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
     * @return string
     */
    public function getAnnee()
    {
        return $this->annee;
    }

    /**
     * @param string $annee
     */
    public function setAnnee($annee)
    {
        $this->annee = $annee;
    }

    /**
     * @return \DateTime
     */
    public function getDatecreation()
    {
        return $this->datecreation;
    }

    /**
     * @param \DateTime $datecreation
     */
    public function setDatecreation($datecreation)
    {
        $this->datecreation = $datecreation;
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
     * @return array
     */
    public function getLignesFraisForfaits()
    {
        return $this->lignesFraisForfaits;
    }

    /**
     * @param array $lignesFraisForfaits
     */
    public function setLignesFraisForfaits($lignesFraisForfaits)
    {
        $this->lignesFraisForfaits = $lignesFraisForfaits;
    }

    /**
     * @return array
     */
    public function getLignesFraisHorsForfaits()
    {
        return $this->lignesFraisHorsForfaits;
    }

    /**
     * @param array $lignesFraisHorsForfaits
     */
    public function setLignesFraisHorsForfaits($lignesFraisHorsForfaits)
    {
        $this->lignesFraisHorsForfaits = $lignesFraisHorsForfaits;
    }


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->lignesFraisForfaits = new \Doctrine\Common\Collections\ArrayCollection();
        $this->lignesFraisHorsForfaits = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add lignesFraisForfait
     *
     * @param \GestionFraisBundle\Entity\LigneFraisForfait $lignesFraisForfait
     *
     * @return FicheFrais
     */
    public function addLignesFraisForfait(\GestionFraisBundle\Entity\LigneFraisForfait $lignesFraisForfait)
    {
        $this->lignesFraisForfaits[] = $lignesFraisForfait;
    
        return $this;
    }

    /**
     * Remove lignesFraisForfait
     *
     * @param \GestionFraisBundle\Entity\LigneFraisForfait $lignesFraisForfait
     */
    public function removeLignesFraisForfait(\GestionFraisBundle\Entity\LigneFraisForfait $lignesFraisForfait)
    {
        $this->lignesFraisForfaits->removeElement($lignesFraisForfait);
    }

    /**
     * Add lignesFraisHorsForfait
     *
     * @param \GestionFraisBundle\Entity\LigneFraisHorsForfait $lignesFraisHorsForfait
     *
     * @return FicheFrais
     */
    public function addLignesFraisHorsForfait(\GestionFraisBundle\Entity\LigneFraisHorsForfait $lignesFraisHorsForfait)
    {
        $this->lignesFraisHorsForfaits[] = $lignesFraisHorsForfait;
    
        return $this;
    }

    /**
     * Remove lignesFraisHorsForfait
     *
     * @param \GestionFraisBundle\Entity\LigneFraisHorsForfait $lignesFraisHorsForfait
     */
    public function removeLignesFraisHorsForfait(\GestionFraisBundle\Entity\LigneFraisHorsForfait $lignesFraisHorsForfait)
    {
        $this->lignesFraisHorsForfaits->removeElement($lignesFraisHorsForfait);
    }
}
