<?php

/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 08/03/2016
 * Time: 18:37
 */

namespace GestionFraisBundle\GestionFiche;

use GestionFraisBundle\Entity\LigneFraisForfait;
use GestionFraisBundle\Entity\FicheFrais;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\ContainerInterface; // <- Add this

class GestionFicheController extends Controller
{
    protected $container; // <- Add this
    public function __construct(ContainerInterface $container) // <- Add this
    {
        $this->container = $container;
    }

    public function creeFiche($visiteur, $em)
    {
        $idEtatFicheFraisDefaut = $this->container->getParameter('idEtatFicheFraisDefaut');

        $uneFicheFrais = new FicheFrais();

        $uneFicheFrais->setIdvisiteur( $visiteur);
        $uneFicheFrais->setMois($this->getMoisActuel());
        $uneFicheFrais->setDatecreation(new \DateTime());
        $uneFicheFrais->setDatemodif(new \DateTime());
        $uneFicheFrais->setMontantvalide(0);
        $uneFicheFrais->setIdetatfichefrais($em->getRepository('GestionFraisBundle:EtatFicheFrais')->findOneById($idEtatFicheFraisDefaut));//On recupère l'etat par defaut

        $em->persist($uneFicheFrais);//on sauvgarde la ficheFrais
        $em->flush();

        $this->creeLignesFraisForfait($uneFicheFrais, $em);//On créée les lignes Frais forfait de cette fiche

        return $uneFicheFrais;
    }
    /*
  * Créée toutes le ligneFraisForfait pour une fiche
  */
    public function creeLignesFraisForfait( $uneFicheFrais, $em)
    {

        $idEtatLigneFraisDefaut = $this->container->getParameter('idEtatLigneFraisDefaut'); // id etatLigneFrais par defaut corespons a "Enregisté" en BDD

        //Recupération de tout les frais forfaits
        $lesFraisForfait = $em->getRepository("GestionFraisBundle:FraisForfait")->findAll();

        $etatParDefaut = $em->getRepository("GestionFraisBundle:EtatLigneFrais")->findOneById($idEtatLigneFraisDefaut);

        foreach($lesFraisForfait as $unFraisForfait) // pour chaque frais forfait
        {
            $uneLigneFraisForfait = new LigneFraisForfait(); // on créé une ligneFraisForfait pour cette fiche
            $uneLigneFraisForfait->setIdfichefrais($uneFicheFrais);
            $uneLigneFraisForfait->setIdfraisforfait($unFraisForfait);
            $uneLigneFraisForfait->setQuantite(0);
            $uneLigneFraisForfait->setIdetatlignefrais($etatParDefaut);
            $em->persist($uneLigneFraisForfait); // on enregistre la fiche
        }
        $em->flush();// sauvgarde bdd
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


    public function estValide($uneFicheFrais)
    {
        if( $this->getMoisActuel() == $uneFicheFrais->getMois())
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}