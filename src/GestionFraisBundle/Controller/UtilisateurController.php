<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 04/12/2015
 * Time: 22:02
 */

namespace GestionFraisBundle\Controller;

use DateTime;
use Doctrine\DBAL\Exception\DatabaseObjectNotFoundException;
use GestionFraisBundle\Entity\FicheFrais;
use GestionFraisBundle\Entity\LigneFraisForfait;
use GestionFraisBundle\Entity\LigneFraisHorsForfait;
use GestionFraisBundle\Form\LigneFraisHorsForfaitType;
use GestionFraisBundle\Form\LigneFraisForfaitType;
use GestionFraisBundle\Form\RechercherFicheFraisType;
use Proxies\__CG__\GestionFraisBundle\Entity\Justificatif;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class UtilisateurController extends Controller
{

    public function saisirFraisAction()
    {
        $visiteurConnecter = $this->getUser();//Visiteur connecté
        $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche

        $em = $this->getDoctrine()->getManager();//connexion bdd
        $uneFicheFrais = $gestionaireFiche->getDerniereFicheFraisValide($visiteurConnecter, $em);

        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
            'operation' => 'modifier'
        ));
    }

    /*
     * Récupere les fiche de l'utilisateur connecté et tout les etat de la table etatFicheFrais
     *  depuis la BDD et les transmet a la vue Utilisateur:index.html.twig
     *
     */
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function RercherFicheFraisAction(Request $request){

        $visiteur = $this->getUser();//Visiteur connecté
        $em = $this->getDoctrine()->getManager();

        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
            array('idvisiteur'=>$this->getUser()),
            array('datecreation' => 'DESC')
        );

        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(new RechercherFicheFraisType(),null,array('role'=>'utilisateur'));

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {
            //On récupere la date du formulaire et on la transforme en chaine de caractères
            $criteres['idvisiteur'] =$visiteur->getId();

            if($form->getData()['mois']){
                $mois = $form->getData()['mois'];
                $criteres['mois']= $mois;
            }
            if($form->getData()['annee']) {
                $annee = $form->getData()['annee'];
                $criteres['annee']= strval($annee);
            }
            //recupération de la  fiches frais corespondant au mois
            $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
                $criteres,
                array('datemodif' => 'DESC'
                ));

            return $this->render('GestionFraisBundle:FicheFrais:RechercherFicheFrais.html.twig', array(
                "lesFicheFrais" =>$lesFicheFrais,
                'form' => $form->createView(),

            ));
        }
        return $this->render('GestionFraisBundle:FicheFrais:RechercherFicheFrais.html.twig', array(
            'lesFicheFrais'=>$lesFicheFrais,
            'form' => $form->createView(),
        ));
    }

    public function consulterFicheFraisAction($idFicheFrais)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->find($idFicheFrais);

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais) {
            throw new DatabaseObjectNotFoundException('Cette fiche n\'existe pas.');
        }
        //On vérifie que la fiche apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneFicheFrais->getIdvisiteur()->getId()) {
            throw new AccessDeniedException('Impossible d’accéder à cette fiche.');
        }

        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
            'operation' => 'consulter'
        ));
    }

    public function justificatifAction(Request $request, $operation , $idJustificatifs)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        switch ($operation){
            case 'ajouter':
                $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
                $unJustificatif = new Justificatif();//On créé une nouvelle ligneFraisForfait
                $unJustificatif->setIdfichefrais($gestionaireFiche->getDerniereFicheFraisValide($this->getUser(),$em));//On attribut cette ligne à la fiche frais

                break;
            case 'suprimer':
                $unJustificatif = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->find($idJustificatifs);
                $em->remove($unJustificatif);//on supprime la ligneFraisforfait
                $em->flush();
                return $this->redirect($this->generateUrl('utilisateur_saisirFrais'));
                break;
            default:
                throw $this->createNotFoundException('Erreur '.$operation);
                break;
        }
        $form = $this->createForm(new ligneFraisForfaitType(), $unJustificatif, array('role'=> 'utilisateur','operation' => $operation));
        $form->handleRequest($request);
    }
    

    public function ligneFraisForfaitAction(Request $request, $operation,  $idLigneFraisForfait)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        if($operation != 'consulter' && $operation != 'ajouter' && $operation != 'suprimer' && $operation != 'modifier'){
            throw $this->createNotFoundException('Erreur '.$operation);
        }

        if($operation == 'ajouter')
        {
            $idEtatLigneFraisDefaut = $this->container->getParameter('idEtatLigneFraisDefaut');
            $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
            //on récupere l'etatLigneFrais "Enregistré"
            $unEtatLigneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findOneById($idEtatLigneFraisDefaut);
            $uneligneFraisForfait = new LigneFraisForfait();//On créé une nouvelle ligneFraisForfait
            $uneligneFraisForfait->setIdfichefrais($gestionaireFiche->getDerniereFicheFraisValide($this->getUser(),$em));//On attribut cette ligne à la fiche frais
            $uneligneFraisForfait->setIdetatlignefrais($unEtatLigneFrais);//On lui donne l'etat enregistré
            $uneligneFraisForfait->setDate(new \DateTime());//on lui passe la date du jour
        }
        else if($operation == 'suprimer'){
            $uneligneFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->find($idLigneFraisForfait);
            $uneligneFraisForfait->getIdfichefrais()->setDatemodif(new DateTime());//on recupere la fiche frais de cette ligne
            $em->remove($uneligneFraisForfait);//on supprime la ligneFraisforfait
            $em->flush();
            return $this->redirect($this->generateUrl('utilisateur_saisirFrais'));
        }
        else $uneligneFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->find($idLigneFraisForfait);

        if($operation != 'consulter'){
            $operation= 'modifier';
        }

        $form = $this->createForm(new ligneFraisForfaitType(), $uneligneFraisForfait, array('role'=> 'utilisateur','operation' => $operation));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $uneligneFraisForfait->getIdfichefrais()->setDatemodif(new DateTime());
            //Calcul du montant de la ligne
            $montantLigne = $uneligneFraisForfait->getQuantite()*$uneligneFraisForfait->getIdfraisforfait()->getMontant();
            $uneligneFraisForfait->setMontant($montantLigne);
            $em->persist($uneligneFraisForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');

            return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
                'uneFicheFrais' => $uneligneFraisForfait->getIdfichefrais(),
                'operation' => $operation
            ));
        }
        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'form' => $form->createView(),
            'nomForm'=> "Frais forfaitaire",
            'operation' => $operation,
            'uneFicheFrais' => $uneligneFraisForfait->getIdfichefrais()
        ));

    }

    public function ligneFraisHorsForfaitAction(Request $request,$idLigneFraisHorsForfait, $operation)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        if($operation != 'consulter' && $operation != 'ajouter' && $operation != 'suprimer' && $operation != 'modifier'){
            throw $this->createNotFoundException('Erreur '.$operation);
        }

        if($operation == 'ajouter')
        {
            $idEtatLigneFraisDefaut = $this->container->getParameter('idEtatLigneFraisDefaut');
            $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
            //on récupere l'etatLigneFrais "Enregistré"
            $unEtatLigneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findOneById($idEtatLigneFraisDefaut);
            $uneligneFraisHorsForfait = new LigneFraisHorsForfait();//On créé une nouvelle ligneFraisHorsForfait
            $uneligneFraisHorsForfait->setIdfichefrais($gestionaireFiche->getDerniereFicheFraisValide($this->getUser(),$em));//On attribut cette ligne à la fiche frais
            $uneligneFraisHorsForfait->setIdetatlignefrais($unEtatLigneFrais);//On lui donne l'etat enregistré
            $uneligneFraisHorsForfait->setDate(new \DateTime());//on lui passe la date du jour
        }
        else if($operation == 'suprimer'){
            $uneligneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->find($idLigneFraisHorsForfait);
            $uneligneFraisHorsForfait->getIdfichefrais()->setDatemodif(new DateTime());//on recupere la fiche frais de cette ligne
            $em->remove($uneligneFraisHorsForfait);//on supprime la ligneFraisforfait
            $em->flush();
            return $this->redirect($this->generateUrl('utilisateur_saisirFrais'));
        }
        else $uneligneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->find($idLigneFraisHorsForfait);

        if($operation != 'consulter'){
            $operation= 'modifier';
        }
        $form = $this->createForm(new ligneFraisHorsForfaitType(), $uneligneFraisHorsForfait, array('role'=> 'utilisateur','operation' => $operation));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $uneligneFraisHorsForfait->getIdfichefrais()->setDatemodif(new DateTime());
            //Calcul du montant de la ligne
            $em->persist($uneligneFraisHorsForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');

            // On redirige vers la fiche frais
            return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
                'uneFicheFrais' => $uneligneFraisHorsForfait->getIdfichefrais(),
                'operation' => $operation,
            ));
        }
        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'form' => $form->createView(),
            'nomForm'=> "Frais forfaitaire",
            'operation' => $operation,
            'uneFicheFrais' => $uneligneFraisHorsForfait->getIdfichefrais()
        ));
    }
    
}