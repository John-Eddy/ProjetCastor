<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 14/12/2015
 * Time: 14:09
 */

namespace GestionFraisBundle\Controller;

use DateTime;
use GestionFraisBundle\Form\FicheFraisType;
use GestionFraisBundle\Form\LigneFraisForfaitType;
use GestionFraisBundle\Form\LigneFraisHorsForfaitType;
use GestionFraisBundle\Form\RechercherFicheFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ComptableController extends Controller
{
    public function RerchercherFicheFraisAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        //id etat cloturé
        $idEtatLigneFraisCloturer = $this->container->getParameter('idetatfichefraiscloture');

        //recupération des  fiches frais triées par mois
        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
            array('idetatfichefrais'=> $em->getRepository('GestionFraisBundle:EtatFicheFrais')->find($idEtatLigneFraisCloturer)),
            array('datemodif' => 'DESC')
        );

        $form = $this->createForm(new RechercherFicheFraisType(), null, array('role'=> 'comptable'));

        $form->handleRequest($request);

        if ($form->isValid())
        {
            $visiteurForm = $form->getData()['utilisateur'];
            $mois = $form->getData()['mois'];
            $annee = $form->getData()['annee'];
            $criteres = array();

            if($visiteurForm){
                $criteres['idvisiteur' ]= $visiteurForm->getId();
            }
            if($form->getData()['mois'])
            {
                $criteres['mois']= $mois;
            }
            if($form->getData()['annee'])
            {
                $criteres['annee']= $annee;
            }

            //recupération de la  fiches frais corespondant au mois
            $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findby(
                $criteres,
                array('datemodif' => 'DESC')
            );


                return $this->render('GestionFraisBundle:FicheFrais:RechercherFicheFrais.html.twig', array(
                    'lesFicheFrais' => $lesFicheFrais,
                    'form' => $form->createView(),
                ));

        }
        return $this->render('GestionFraisBundle:FicheFrais:RechercherFicheFrais.html.twig', array(
            'lesFicheFrais' => $lesFicheFrais,
            'form' => $form->createView(),
        ));

    }
    public function ValiderFicheFraisAction($idFicheFrais)
    {
        $em = $this->getDoctrine()->getManager();//connexion bdd

        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->find($idFicheFrais);
        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais) {
            throw $this->createNotFoundException('Cette fiche n\'existe pas.');
        }
        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
            'operation' => 'valider'
        ));
    }



    public function ConsulterFicheFraisAction($idFicheFrais)
    {
        $em = $this->getDoctrine()->getManager();
        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(array(
            'id' => $idFicheFrais));

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais) {
            throw $this->createNotFoundException('Cette fiche n\'existe pas.');
        }

        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
            'operation' => 'consulter'
        ));
    }

    public function cloturerFicheFraisAction()
    {
        $idEtatLigneFraisCloturer = $this->container->getParameter('idetatfichefraiscloture');
        $em = $this->getDoctrine()->getManager();
        $mois =null;
        $annee = null;
        if(date('m') == 1 ){
            $mois = 12;
            $annee = strval(date('Y')-1);
        }
        else{
            $mois=date('m')-1;
            $annee=strval(date('Y'));
        }
        if($mois <10 )$mois = "0".strval($mois);

        else$mois=strval($mois);

        //recupération des  fiches frais triées par mois
        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(array(
            'mois' => $mois,
            'annee'=> $annee
        ));
        foreach($lesFicheFrais as $uneFicheFrais)
        {
            $uneFicheFrais->setIdetatfichefrais($em->getRepository('GestionFraisBundle:EtatFicheFrais')->find($idEtatLigneFraisCloturer));
            $em->persist($uneFicheFrais);

        }
        $em->flush();
        return $this->redirectToRoute('comptable_index');
    }

    public function ligneFraisForfaitAction(Request $request, $idLigneFraisForfait, $operation)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        if($operation != 'consulter' &&  $operation != 'valider'){
            throw $this->createNotFoundException('Erreur '.$operation);
        }
        else $uneligneFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->find($idLigneFraisForfait);


        $form = $this->createForm(new ligneFraisForfaitType(), $uneligneFraisForfait, array('role'=> 'comptable','operation' => $operation));
        $form->handleRequest($request);

        if ($form->isValid()) {

            $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
            $uneligneFraisForfait->getIdfichefrais()->setMontantvalide($gestionaireFiche->calculerMontantValider($uneligneFraisForfait->getIdfichefrais()));
            $uneligneFraisForfait->getIdfichefrais()->setDatemodif(new DateTime());
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

    public function ligneFraisHorsForfaitAction(Request $request, $idLigneFraisHorsForfait, $operation)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        if($operation != 'consulter' &&  $operation != 'valider'){
            throw $this->createNotFoundException('Erreur '.$operation);
        }
        else $uneligneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->find($idLigneFraisHorsForfait);


        $form = $this->createForm(new ligneFraisHorsForfaitType(), $uneligneFraisHorsForfait, array('role'=> 'comptable','operation' => $operation));
        $form->handleRequest($request);

        if ($form->isValid()) {
            $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
            //calcul du montant valide
            $uneligneFraisHorsForfait->getIdfichefrais()->setMontantvalide($gestionaireFiche->calculerMontantValider($uneligneFraisHorsForfait->getIdfichefrais()));
            $uneligneFraisHorsForfait->getIdfichefrais()->setDatemodif(new DateTime());
            $em->persist($uneligneFraisHorsForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');

            return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
                'uneFicheFrais' => $uneligneFraisHorsForfait->getIdfichefrais(),
                'operation' => $operation
            ));
        }
        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'form' => $form->createView(),
            'nomForm'=> "Frais forfaitaire",
            'operation' => $operation,
            'uneFicheFrais' => $uneligneFraisHorsForfait->getIdfichefrais()
        ));

    }

    public function modifierEtatFicheFraisAction(Request $request, $idFicheFrais)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        $uneFicheFrais = $em->getRepository("GestionFraisBundle:FicheFrais")->find($idFicheFrais);

        $form = $this->createForm(new FicheFraisType(), $uneFicheFrais);
        $form->handleRequest($request);

        if ($form->isValid()) {

            $em->persist($uneFicheFrais);
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Fiche frais bien enregistrée.');

            return $this->redirect($this->generateUrl('comptable_consulterfichefrais',array('idFicheFrais' => $idFicheFrais )));

        }
        return $this->render('GestionFraisBundle:FicheFrais:modifierFicheFrais.html.twig', array(
            'form' => $form->createView(),
            'nomForm'=> "Etat Fiche Frais",
            'operation' => "consulter",
            'uneFicheFrais' =>$uneFicheFrais
        ));

    }




  }