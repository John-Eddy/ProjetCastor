<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 25/02/2016
 * Time: 20:36
 */

namespace GestionFraisBundle\Utils;

class FicheFraisComplete
{


    private $visiteur;
    private $ficheFrais;
    private $etatFicheFrais;
    private $lesLigneFraisForfait = array();
    private $lesLigneFraisHorsForfait = array();

    /**
     * FicheCompete constructor.
     * @param $visiteur
     * @param $ficheFrais
     * @param array $lesLigneFraisHorsForfait
     * @param array $lesLigneFraisForfait
     * @param $etatFicheFrais
     */
    public function __construct()
    {
        $this->visiteur = null;
        $this->ficheFrais = null;
        $this->lesLigneFraisHorsForfait = null;
        $this->lesLigneFraisForfait = null;
        $this->etatFicheFrais = null;
    }

    /**
     * @return mixed
     */
    public function getVisiteur()
    {
        return $this->visiteur;
    }

    /**
     * @param mixed $visiteur
     */
    public function setVisiteur($visiteur)
    {
        $this->visiteur = $visiteur;
    }

    /**
     * @return mixed
     */
    public function getFicheFrais()
    {
        return $this->ficheFrais;
    }

    /**
     * @param mixed $ficheFrais
     */
    public function setFicheFrais($ficheFrais)
    {
        $this->ficheFrais = $ficheFrais;
    }

    /**
     * @return mixed
     */
    public function getEtatFicheFrais()
    {
        return $this->etatFicheFrais;
    }

    /**
     * @param mixed $etatFicheFrais
     */
    public function setEtatFicheFrais($etatFicheFrais)
    {
        $this->etatFicheFrais = $etatFicheFrais;
    }

    /**
     * @return array
     */
    public function getLesLigneFraisForfait()
    {
        return $this->lesLigneFraisForfait;
    }

    /**
     * @param array $lesLigneFraisForfait
     */
    public function setLesLigneFraisForfait($lesLigneFraisForfait)
    {
        $this->lesLigneFraisForfait = $lesLigneFraisForfait;
    }

    /**
     * @return array
     */
    public function getLesLigneFraisHorsForfait()
    {
        return $this->lesLigneFraisHorsForfait;
    }

    /**
     * @param array $lesLigneFraisHorsForfait
     */
    public function setLesLigneFraisHorsForfait($lesLigneFraisHorsForfait)
    {
        $this->lesLigneFraisHorsForfait = $lesLigneFraisHorsForfait;
    }


}