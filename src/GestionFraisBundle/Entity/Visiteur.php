<?php

namespace GestionFraisBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;

/**
 * Visiteur
 *
 * @ORM\Table(name="visiteur", uniqueConstraints={@ORM\UniqueConstraint(name="UNIQ_username", columns={"username_canonical"}), @ORM\UniqueConstraint(name="UNIQ_email", columns={"email_canonical"})})
 * @ORM\Entity
 *
 * @ExclusionPolicy("all")
 */
class Visiteur extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     * @Expose
     */
    private $nom;

    /**
     * @var string
     *
     * @ORM\Column(name="prenom", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     *
     * @Expose
     */
    private $prenom;

    /**
     * @var string
     *
     * @ORM\Column(name="adresse", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     *
     * @Expose
     */
    private $adresse;

    /**
     * @var string
     *
     * @ORM\Column(name="cp", type="string", length=5, precision=0, scale=0, nullable=false, unique=false)
     */
    private $cp;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=100, precision=0, scale=0, nullable=false, unique=false)
     */
    private $ville;

    /**
     * Set nom
     *
     * @param string $nom
     *
     * @return Visiteur
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Visiteur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set adresse
     *
     * @param string $adresse
     *
     * @return Visiteur
     */
    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * Get adresse
     *
     * @return string
     */
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set cp
     *
     * @param string $cp
     *
     * @return Visiteur
     */
    public function setCp($cp)
    {
        $this->cp = $cp;

        return $this;
    }

    /**
     * Get cp
     *
     * @return string
     */
    public function getCp()
    {
        return $this->cp;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Visiteur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
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

    public function getRoleStr(){

        if(in_array('ROLE_ADMIN',$this->getRoles()))
        {
            return 'administrateur';
        }

        else if (in_array('ROLE_COMPTABLE',$this->getRoles()))
        {
            return 'comptable';
        }
        else
        {
            return"utilisateur";
        }
    }

    /**
     * Get the formatted name to display (NAME Firstname or username)
     *
     * @param $separator: the separator between name and firstname (default: ' ')
     * @return String
     * @VirtualProperty
     */
    public function getUsedName($separator = ' '){
        if($this->getNom()!=null && $this->getPrenom()!=null){
            return ucfirst(strtolower($this->getPrenom())).$separator.strtoupper($this->getNom());
        }
        else{
            return $this->getUserName();
        }
    }
}
