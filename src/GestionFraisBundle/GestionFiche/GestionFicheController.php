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
        $gestionaireDate =  $this->container->get("gestionfrais.gestionairedate");

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
    /**
     * @param $uneFicheFrais
     * @return bool
     */
    public function estEnCour($uneFicheFrais)
    {
        $idEtatFicheFraisEnCours = $idEtatLigneFraisValider = $this->container->getParameter('idetatfichefraisdefaut');

        if ($uneFicheFrais == null){//si la fiche frais est null
            return false;
        }
        //si l'etat de la fiche n'est pas saisi en cour est valider
        else if($uneFicheFrais->getIdetatfichefrais()->getId() !=  $idEtatFicheFraisEnCours )
        {
            return false;
        }
        else if( $uneFicheFrais->getMois() == date('m') || strval(date('Y')) == $uneFicheFrais->getAnnee())//si la fiche frais est du mois en cour
        {
            return true;
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
        if(!empty($lesFichesFrais)) {
            return $lesFichesFrais[0];
        }
        else  false ;
    }

    public function getDerniereFicheFraisValide( $visiteur, $em){

        $derniereFiche = $this->getDerniereFicheFrais($visiteur,$em);
        if( $this->estEnCour($derniereFiche))
        {
            return $this->creeFiche($visiteur, $em);
        }
        else{
            return$this->creeFiche($visiteur, $em);
        }
    }

    /**
     * @param $uneFicheFrais
     * @param $em
     * @return mixed
     */
    public function chargerLignesFrais($uneFicheFrais, $em)
    {
        $uneFicheFrais->setLignesFraisForfaits( $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(
            array(
                'idfichefrais' => $uneFicheFrais
            )
        ));

        $uneFicheFrais->setLignesFraisHorsForfaits( $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findBy(
            array(
                'idfichefrais' => $uneFicheFrais
            )
        ));

        return $uneFicheFrais;
    }
}