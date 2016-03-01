<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 26/02/2016
 * Time: 12:30
 */

namespace GestionFraisBundle\Utils;



class LigneFraisHorsForfait
{
    private $LigneFraisHorsForfait;
    private $etatLigneFrais;


    public function __construct($uneLigneFraisForfait, $etatLigneFrais)
    {
        $fraisForfait = null;
        $etatLigneFrais = null;

    }

    /**
     * @return mixed
     */
    public function getLigneFraisHorsForfait()
    {
        return $this->LigneFraisHorsForfait;
    }

    /**
     * @param mixed $LigneFraisHorsForfait
     */
    public function setLigneFraisHorsForfait($LigneFraisHorsForfait)
    {
        $this->LigneFraisHorsForfait = $LigneFraisHorsForfait;
    }

    /**
     * @return mixed
     */
    public function getEtatLigneFrais()
    {
        return $this->etatLigneFrais;
    }

    /**
     * @param mixed $etatLigneFrais
     */
    public function setEtatLigneFrais($etatLigneFrais)
    {
        $this->etatLigneFrais = $etatLigneFrais;
    }

}