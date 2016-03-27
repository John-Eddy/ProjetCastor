<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 14/12/2015
 * Time: 14:09
 */

namespace GestionFraisBundle\Controller;

use GestionFraisBundle\Form\RechercherFicheFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ComptableController extends Controller
{
    public function indexAction(Request $request){

        $em = $this->getDoctrine()->getManager();

        //recupération des  fiches frais triées par mois
        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findAll(
            array('datecreation' => 'DESC')
        );



        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(
            new RechercherFicheFraisType(),
            null,
            array(
                'type'=> 'comptable'
            ));

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $form contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid())
        {
            //On récupere la date du formulaire et on la transforme en chaine de caractères

            $visiteurForm = $form->getData()['Visiteur'];

            $criteres = array();
            if($visiteurForm){
                $criteres['idvisiteur' ]= $visiteurForm->getId();
            }
            if($form->getData()['mois'])
            {
                $dateForm = date_format($form->getData()['mois'], 'Y-m-d H:i:s');
                $mois = substr($dateForm, 5, 2);
                $annee =substr($dateForm, 0, 4); // on extrait le mois et l'année de la chaine et on les mets au format mmaaaa
                $criteres['mois']= $mois;
                $criteres['annee'] =$annee;

            }
            //recupération de la  fiches frais corespondant au mois
            $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findby($criteres);

          /*  //verification de l'éxistance de la fiche de frais :
            if (!$uneFicheFrais) {
                throw $this->createNotFoundException('Fiche introuvable.');
            }

            // On redirige vers la fiche frais
            return $this->redirect($this->generateUrl('ficheFrais_afficher', array('id' => $uneFicheFrais->getId())));
          */
            return $this->render('GestionFraisBundle:Comptable:index.html.twig', array(
                'lesFicheFrais' => $lesFicheFrais,
                'form' => $form->createView(),
            ));
        }
    }
    /*
     * Affiche la fiche frais correspondant au parametres fournis avec la possibilité de modifier l'etat des lignes et de la fiche
     *
     */
    public function validerFicheAction($idFicheFrais)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(array(
            'id' => $idFicheFrais));

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais) {
            throw $this->createNotFoundException('Fiche introuvable.');
        }

        //recupération des ligne de frais forfait de cette fiche
        $lesLignesFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(
            array(
                'idfichefrais' => $idFicheFrais,
            )
        );

        //recupération des ligne de frais hors forfait de cette fiche
        $lesLignesFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findBy(
            array(
                'idfichefrais' => $idFicheFrais,
            )
        );

        //retourne la vue validé fiche
        return $this->render('GestionFraisBundle:Comptable/FicheFrais:valider.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
            'lesLignesFraisForfait' => $lesLignesFraisForfait,
            'lesLignesFraisHorsForfait' => $lesLignesFraisHorsForfait,
        ));
    }

    public function validerLigneFraisForfait($idLigneFraisForfait)
    {
        throw $this->createNotFoundException('Ligne Frais GG Liza.');
    }

}