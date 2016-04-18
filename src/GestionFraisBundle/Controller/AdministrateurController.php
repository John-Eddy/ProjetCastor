<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 05/04/2016
 * Time: 14:28
 */

namespace GestionFraisBundle\Controller;

use GestionFraisBundle\Entity\FraisForfait;
use GestionFraisBundle\Entity\Visiteur;
use GestionFraisBundle\Form\FraisForfaitType;
use GestionFraisBundle\Form\RechercherFraisForfaitType;
use GestionFraisBundle\Form\RechercherVisiteurType;
use GestionFraisBundle\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdministrateurController extends Controller{

    public function RerchercherfraisforfaitAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $lesFraisForfait = $em->getRepository('GestionFraisBundle:FraisForfait')->findAll();
        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(new RechercherFraisForfaitType(),null);

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {
            //On récupere la date du formulaire et on la transforme en chaine de caractères


            return $this->render('GestionFraisBundle:FraisForfait:rechercherFraisForfait.html.twig', array(
                "lesFraisForfaits" => array(0=>$form->getData()['FraisForfait']),
                'form' => $form->createView(),

            ));
        }
        return $this->render('GestionFraisBundle:FraisForfait:rechercherFraisForfait.html.twig', array(
            "lesFraisForfaits" => $lesFraisForfait,
            'form' => $form->createView(),

        ));
    }

    public function fraisforfaitAction(Request $request,$idFraisForfait, $operation)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        if($operation != 'consulter' && $operation != 'ajouter' && $operation != 'suprimer' && $operation != 'modifier') {
            throw $this->createNotFoundException();
        }

        if($operation == 'ajouter')
        {
            $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
            //on récupere l'etatLigneFrais "Enregistré"
            $unFraisForfait = new FraisForfait();//On créé une nouvelle FraisForfait
        }
        else if($operation == 'suprimer'){
            $unFraisForfait = $em->getRepository('GestionFraisBundle:FraisForfait')->find($idFraisForfait);
            $em->remove($unFraisForfait);//on supprime la FraisForfait
            $em->flush();
            return $this->redirect($this->generateUrl('administrateur_index'));
        }
        else $unFraisForfait = $em->getRepository('GestionFraisBundle:FraisForfait')->find($idFraisForfait);


        $form = $this->createForm(new FraisForfaitType(), $unFraisForfait);

        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($unFraisForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'FraisForfait enregistrée.');

            return $this->render('GestionFraisBundle::form\afficherFormulaire.html.twig', array(
                'operation' => $operation
            ));
        }
        return $this->render('GestionFraisBundle::form\afficherFormulaire.html.twig', array(
            'form' => $form->createView(),
            'nomForm'=> "FraisForfait",
            'operation' => $operation,
        ));
    }


    public function RercherchervisiteurAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $lesVisiteur = $em->getRepository('GestionFraisBundle:Visiteur')->findAll();
        // À partir du formBuilder, on génère le formulaire        $form = $this->createForm(new RechercherVisiteurType(),null);

        $form = $this->createForm(new RechercherVisiteurType(),null , array('role'=>'administrateur'));

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {
            //On récupere la date du formulaire et on la transforme en chaine de caractères


            return $this->render('GestionFraisBundle:Visiteur:rechercherVisiteur.html.twig', array(
                "lesVisiteurs" => array(0=>$form->getData()['visiteur']),
                'form' => $form->createView(),
                'nomForm'=> "Visiteur",

            ));
        }
        return $this->render('GestionFraisBundle:Visiteur:rechercherVisiteur.html.twig', array(
            "lesVisiteurs" => $lesVisiteur,
            'form' => $form->createView(),

        ));
    }


    public function visiteurAction(Request $request,$operation , $idVisiteur){

        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        if($operation != 'consulter' && $operation != 'ajouter' && $operation != 'suprimer' && $operation != 'modifier') {
            throw $this->createNotFoundException();
        }
        
        if($operation == 'ajouter')
        {
            $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
            //on récupere l'etatLigneFrais "Enregistré"
            $unVisiteur = new Visiteur();//On créé une nouvelle Visiteur
        }
        else if($operation == 'suprimer'){
            $unVisiteur = $em->getRepository('GestionFraisBundle:Visiteur')->find($idVisiteur);
            $em->remove($unVisiteur);//on supprime la Visiteur
            $em->flush();
            return $this->redirect($this->generateUrl('administrateur_index'));
        }
        else $unVisiteur = $em->getRepository('GestionFraisBundle:Visiteur')->find($idVisiteur);

        if($operation == 'consulter')
        {
            return $this->render('GestionFraisBundle:Visiteur:consulterVisiteur.html.twig', array(
                "unVisiteur"=>$unVisiteur,
            ));
        }

        $form = $this->createForm(new VisiteurType(), $unVisiteur, array('role' => 'administrateur'));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($unVisiteur);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Visiteur enregistrée.');

            return $this->render('GestionFraisBundle::form\afficherFormulaire.html.twig', array(
                'operation' => $operation
            ));
        }
        return $this->render('GestionFraisBundle::form\afficherFormulaire.html.twig', array(
            'form' => $form->createView(),
            'operation' => $operation,
        ));
    }



}