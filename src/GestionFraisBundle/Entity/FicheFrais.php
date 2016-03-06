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



    public function __construct(Visiteur $visiteur)
    {

        $idEtatFicheFraisDefaut = 1; // id etatFicheFrais par defaut corespons a "Fiche créée, saisie en cour" en BDD
        $em = $this->getDoctrine()->getManager();//Connection BDD

        $this->idvisiteur = $visiteur;
        $this->mois = $this->getMoisActuel();
        $this->datecreation = new \DateTime();
        $this->datemodif = new \DateTime();
        $this->idetatfichefrais($em->getRepository('GestionFraisBundle:EtatFicheFrais')->findOneById($idEtatFicheFraisDefaut));//On recupère l'etat par defaut

        $em->persist($this);//on sauvgarde la ficheFrais
        $em->flush();

        $this->creeLigneFraisForfait();//On créée les lignes Frais forfait de cette fiche

    }

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

    public function estValide()
    {
        if( $this->getMoisActuel() == $this->getMois())
        {
           return true;
        }
        else
        {
            return false;
        }
    }

    /*
     * Determine et retourne le mois d'une fiche pour le jour actuel au format mmaaaa
     */
    public function getMoisActuel()
    {
        $dateActuel = new \DateTime("now"); // on recupère la date actuel
        $dateActuelStr= date_format($dateActuel, 'Y-m-d H:i:s');// on convertis la date actuel en chaine de caractères

        $moisActuel = intval(substr($dateActuelStr,5,2)); // on extrais le mois de la chaine et on le convertis en entier
        $anneeActuel = intval(substr($dateActuelStr,0,4));// on extrais l'année de la chaine et on le convertis en entier
        $jourActuel = intval(substr($dateActuelStr,8,2));// on extrais le jout de la chaine et on le convertis en entier

        if($jourActuel < 12)//si nous somme avant le 11 du mois
        {
            if ($moisActuel == 1) // si on est au mois de janvier
            {
                $moisNouvelleFiche = 12;
                $anneNouvelleFiche = $anneeActuel-1;
            }
            else
            {
                $moisNouvelleFiche = $moisActuel-1;
                $anneNouvelleFiche = $anneeActuel;
            }
        }
        else
        {
            $moisNouvelleFiche = $moisActuel;
            $anneNouvelleFiche = $anneeActuel;
        }
        if ($moisNouvelleFiche < 10 )//si le mois est inferieur a 10 on rajout un 0 avant ex: 0 -> 01
        {
            $moisNouvelleFiche = "0".strval($moisNouvelleFiche).strval($anneNouvelleFiche);
        }
        else
        {
            $moisNouvelleFiche = strval($moisNouvelleFiche).strval($anneNouvelleFiche);
        }
        return $moisNouvelleFiche;
    }

    /*
     * Créée toutes le ligneFraisForfait pour une fiche
     */
    public function creeLigneFraisForfait()
    {

        $em = $this->getDoctrine()->getManager();//Connection BDD

        //Recupération de tout les frais forfaits
        $lesFraisForfait = $em->getRepository("GestionFraisBundle:EtatLigneFrais")->findOAll();

        foreach($lesFraisForfait as $unFraisForfait) // pour chaque frais forfait
        {
            $uneLigneFraisForfait = new LigneFraisForfait($this, $unFraisForfait); // on créé une ligneFraisForfait pour cette fiche
            $em->persist($uneLigneFraisForfait); // on enregistre la fiche
        }
        $em->flush();// sauvgarde bdd
    }

    public function getLigneFraisForfait()
    {

    }
}
