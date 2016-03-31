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
        $uneFicheFrais->setMois($gestionaireDate->getMoisFicheEnCoursStr());
        $uneFicheFrais->setAnnee($gestionaireDate->getAnneeFicheEnCoursStr());
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
     * @param $uneFicheFrais
     * @return bool
     */
    public function estValide($uneFicheFrais)
    {
        $gestionaireDate =  $this->container->get("gestionfrais.gestionairedate");


        if( $gestionaireDate->getMoisFicheEnCoursStr() == $uneFicheFrais->getMois() || $gestionaireDate->getAnneeFicheEnCoursStr() == $uneFicheFrais->getAnnee())
        {
            return true;
        }
        else
        {
            return false;
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


        if(!empty($lesFichesFrais)) return $lesFichesFrais[0];
        else return false ;
    }

    public function getDerniereFicheFraisValide( $visiteur, $em){

        $derniereFicheValide = $this->getDerniereFicheFrais($visiteur,$em);
        if($this->estValide($derniereFicheValide)){
            return $derniereFicheValide;
        }
        else return$this->creeFiche($visiteur, $em);
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

    public function erreur($message)
    {
        dump($message);
        return $this->render('GestionFraisBundle:Erreur:erreur.html.twig', array(
            'message' => $message,
        ));
    }


}