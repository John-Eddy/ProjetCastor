<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 26/02/2016
 * Time: 12:30
 */

namespace GestionFraisBundle\Utils;


class LigneFraisForfaitComplete
{

    private $LigneFraisForfait;
    private $etatLigneFrais;
    private $FraisForfait;


    public function __construct()
    {
        $fraisForfait = null;
        $etatLigneFrais = null;
        $fraisForfait = null;

    }

    /**
     * @return mixed
     */
    public function getLigneFraisForfait()
    {
        return $this->LigneFraisForfait;
    }

    /**
     * @param mixed $LigneFraisForfait
     */
    public function setLigneFraisForfait($LigneFraisForfait)
    {
        $this->LigneFraisForfait = $LigneFraisForfait;
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

    /**
     * @return mixed
     */
    public function getFraisForfait()
    {
        return $this->FraisForfait;
    }

    /**
     * @param mixed $FraisForfait
     */
    public function setFraisForfait($FraisForfait)
    {
        $this->FraisForfait = $FraisForfait;
    }

}
