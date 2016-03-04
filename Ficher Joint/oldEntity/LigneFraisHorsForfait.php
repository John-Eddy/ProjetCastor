<?php

namespace GestionFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * LigneFraisHorsForfait
 *
 * @ORM\Table(name="ligne_frais_hors_forfait", indexes={@ORM\Index(name="idEtatLigneFrais", columns={"idEtatLigneFrais"}), @ORM\Index(name="idEtatLigneFrais_2", columns={"idEtatLigneFrais"}), @ORM\Index(name="idFicheFrais", columns={"idFicheFrais"})})
 * @ORM\Entity
 */
class LigneFraisHorsForfait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date", nullable=false)
     */
    private $date;

    /**
     * @Assert\File(maxSize="1000k")
     */
    public $file;

    /**
     * @return string
     */

    /**
     * @var string
     *
     * @ORM\Column(name="justificatif", type="string", length=255)
     */
    private $justificatif;

    /**
     * @var float
     *
     * @ORM\Column(name="montant", type="float", precision=10, scale=0, nullable=false)
     */
    private $montant;

    /**
     * @var string
     *
     * @ORM\Column(name="libelleLigneHorsForfait", type="string", length=255, nullable=false)
     */
    private $libellelignehorsforfait;

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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return LigneFraisHorsForfait
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set montant
     *
     * @param float $montant
     *
     * @return LigneFraisHorsForfait
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
     * Set libellelignehorsforfait
     *
     * @param string $libellelignehorsforfait
     *
     * @return LigneFraisHorsForfait
     */
    public function setLibellelignehorsforfait($libellelignehorsforfait)
    {
        $this->libellelignehorsforfait = $libellelignehorsforfait;
    
        return $this;
    }

    /**
     * Get libellelignehorsforfait
     *
     * @return string
     */
    public function getLibellelignehorsforfait()
    {
        return $this->libellelignehorsforfait;
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
     * @return LigneFraisHorsForfait
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
     * @return LigneFraisHorsForfait
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

    public function getJustificatif()
    {
        return $this->justificatif;
    }

    /**
     * @param string $justificatif
     */
    public function setJustificatif($justificatif)
    {
        $this->justificatif = $justificatif;
    }

    protected function getUploadDir()
    {
        return 'uploads/Justificatifs';
    }

    protected function getUploadRootDir()
    {
        return __DIR__.'/../../../../web/'.$this->getUploadDir();
    }

    public function getWebPath()
    {
        return null === $this->logo ? null : $this->getUploadDir().'/'.$this->logo;
    }

    public function getAbsolutePath()
    {
        return null === $this->logo ? null : $this->getUploadRootDir().'/'.$this->logo;
    }
}
