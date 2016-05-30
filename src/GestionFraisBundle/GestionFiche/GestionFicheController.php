<?php

/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 08/03/2016
 * Time: 18:37
 */

namespace GestionFraisBundle\GestionFiche;

use GestionFraisBundle\Entity\FicheFrais;

use GestionFraisBundle\Entity\Visiteur;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\DependencyInjection\ContainerInterface;

class GestionFicheController extends Controller
{
    protected $container; // <- Add this

    /**
     * GestionFicheController constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container) // <- Add this
    {
        $this->container = $container;
    }

    /**
     * @param $visiteur
     * @param $em
     * @return FicheFrais
     */
    public function creeFiche($visiteur, $em)
    {
        //on recupere l'id etatFicheFrais dans les parametre
        $idEtatFicheFraisDefaut = $this->container->getParameter('idEtatFicheFraisDefaut');

        $uneFicheFrais = new FicheFrais();

        $uneFicheFrais->setIdvisiteur($visiteur);
        $uneFicheFrais->setMois(date('m'));
        $uneFicheFrais->setAnnee(date('Y'));
        $uneFicheFrais->setDatecreation(new \DateTime());
        $uneFicheFrais->setDatemodif(new \DateTime());
        $uneFicheFrais->setMontantvalide(0);
        //On recupère l'etat par defaut
        $uneFicheFrais->setIdetatfichefrais($em->getRepository('GestionFraisBundle:EtatFicheFrais')->findOneById($idEtatFicheFraisDefaut));
        $em->persist($uneFicheFrais);//on sauvgarde la ficheFrais
        $em->flush();

        return $uneFicheFrais;
    }


    /**
     *
     * Fonction qui calcule la montant valide d'un fiche en fonction de l'etat de chaque ligne frais
     * @param $uneFicheFrais
     * @return int
     */
    public function calculerMontantValider($uneFicheFrais)
    {
        $montantValide=0;
        $idEtatLigneFraisValider = $this->container->getParameter('idetatlignefraisvalider');

            foreach($uneFicheFrais->getLignesFraisForfaits() as $uneLigneFraisForfait){
                if($uneLigneFraisForfait->getIdetatlignefrais()->getId() == $idEtatLigneFraisValider)
                {
                    $montantValide += $uneLigneFraisForfait->getMontant();
                }
            }
            foreach($uneFicheFrais->getLignesFraisHorsForfaits() as $uneLigneFraisHorsForfait){
                if($uneLigneFraisHorsForfait->getIdetatlignefrais()->getId() == $idEtatLigneFraisValider)
                {
                    $montantValide += $uneLigneFraisHorsForfait->getMontant();
                }
            }

        return $montantValide;
    }

    public function getDerniereFicheFraisValide( $visiteur, $em){

        $idEtatFicheFraisCLoture = $this->container->getParameter('idetatfichefraiscloture');

        //on récupère la dérnière fiche frais
        $derniereFiche = $this->getDerniereFicheFrais($visiteur,$em);
        //si l'etat de celle-ci est "saisie en cour"
        if( $this->estEnCour($derniereFiche))
        {
            //on la retourne
            return $derniereFiche;
        }
        else{
            //si il existe un derniere fiche
            if($derniereFiche != null){
                //on la cloture avant d'en créée une nouvelle
                $derniereFiche->setEtatFicheFrais($idEtatFicheFraisCLoture);
                $em->persist($derniereFiche);
                $em->flush();
            }
            //on cree une nouvelle fiche
            return $this->creeFiche($visiteur, $em);
        }
    }

    /**
     * @param $em
     * @param $visiteur
     * @return mixed
     */
    public function getDerniereFicheFrais($visiteur, $em)
    {
        //recupération de la derniere fiche frais
        $lesFichesFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
            array('idvisiteur' => $visiteur->getId()),
            array('datecreation' => 'DESC')
        );
        //
        if(!empty($lesFichesFrais)) {
            return $lesFichesFrais[0];
        }
        else  return null ;
    }

    /**
     * @param $uneFicheFrais
     * @return bool
     */
    public function estEnCour($uneFicheFrais)
    {
        $idEtatFicheFraisEnCours = $idEtatLigneFraisValider = $this->container->getParameter('idetatfichefraisdefaut');

        //si la fiche frais n'existe pas
        if ($uneFicheFrais == null){
            return false;
        }
        //si l'etat de la fiche n'est pas "saisie en cour"
        else if($uneFicheFrais->getIdetatfichefrais()->getId() !=  $idEtatFicheFraisEnCours )
        {
            return false;
        }
        //si le mois et l'année de la fiche frais corespondent au mois et à l'année actuel
        else if( $uneFicheFrais->getMois() == date('m') || strval(date('Y')) == $uneFicheFrais->getAnnee())
        {
            return true;
        }

    }


}