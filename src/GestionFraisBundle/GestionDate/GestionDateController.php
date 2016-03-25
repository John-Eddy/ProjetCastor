<?php

/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 21/03/2016
 * Time: 18:10
 */

namespace GestionFraisBundle\GestionDate;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Validator\Constraints\DateTime;


class GestionDateController extends Controller
{
    private $dateEnCourse;

    public function __construct()
    {

        $this->dateEnCourse = date_format(new \DateTime(), 'Y-m-d H:i:s');// on convertis la date EnCours en chaine de caractères
    }

    public function getJourActuelStr()
    {
         return(substr($this->dateEnCourse,8,2));// on extrais le jout de la chaine et on le convertis en entier
    }

    public function getMoisActuelStr()
    {
        return (substr($this->dateEnCourse,5,2));// on extrais le jout de la chaine et on le convertis en entier
    }

    public function getAnneeActuelleStr()
    {
        return (substr($this->dateEnCourse,0,4));// on extrais le jout de la chaine et on le convertis en entier
    }
    public function getJourActuelInt()
    {
        return intval(substr($this->dateEnCourse,8,2));// on extrais le jout de la chaine et on le convertis en entier
    }

    public function getMoisActuelInt()
    {
        return intval(substr($this->dateEnCourse,5,2));// on extrais le jout de la chaine et on le convertis en entier
    }

    public function getAnneeActuelleInt()
    {
        return intval(substr($this->dateEnCourse,0,4));// on extrais le jout de la chaine et on le convertis en entier
    }

    public function getMoisFicheEnCoursInt()
    {
        if($this->getJourActuelInt() < 12)//si nous somme avant le 11 du mois
        {
            if ($this->getMoisActuelInt() == 1) // si on est au mois de janvier
            {
                return  12;
            }
            else
            {
                return  $this->getMoisActuelInt()-1;
            }
        }
        else
        {
            return  $this->getMoisActuelInt();
        }

    }
    public function getAnneeFicheEnCoursStr()
    {
        if($this->getJourActuelInt() < 12)//si nous somme avant le 11 du mois
        {
            if ($this->getMoisActuelInt() == 1) // si on est au mois de janvier
            {
                return  strval($this->getAnneeActuelleInt()-1);
            }
            else
            {
                return  strval($this->getAnneeActuelleInt());
            }
        }
        else
        {
            return  strval($this->getAnneeActuelleInt());
        }
    }
    public function getMoisFicheEnCoursStr()
    {
        $moisFicheEncourInt = $this->getMoisFicheEnCoursInt();

        if ($moisFicheEncourInt < 10 )//si le mois est inferieur a 10 on rajout un 0 avant ex: 0 -> 01
        {
            return  "0".strval($moisFicheEncourInt);
        }
        else
        {
            return strval($moisFicheEncourInt);
        }
    }

}