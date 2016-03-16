<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 14/12/2015
 * Time: 14:09
 */

namespace GestionFraisBundle\Controller;

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

        //création du formulaire de recherche de fiche
        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form');

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('Visiteur','entity', array(
                'class' => 'GestionFraisBundle:Visiteur',
                'choice_label' => 'username',
            ))
            ->add('mois', 'date',
                array(
                    'format' => 'yyyy-MM-dd',
                    'placeholder' => array(
                        'year' => 'Année', 'month' => 'Mois'
                    ),
                    'days' => range(1,1),
                )
            )
            ->add('Rechercher', 'submit' )
        ;

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $form contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid())
        {
            //On récupere la date du formulaire et on la transforme en chaine de caractères
            $dateForm = date_format($form->getData()['mois'], 'Y-m-d H:i:s');

            $visiteurForm = $form->getData()['Visiteur'];

            $mois  = substr($dateForm,5,2).substr($dateForm,0,4); // on extrait le mois et l'année de la chaine et on les mets au format mmaaaa

            //recupération de la  fiches frais corespondant au mois
            $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(array(
                'idvisiteur' => $visiteurForm->getId(),
                'mois' => $mois
            ));

            //verification de l'éxistance de la fiche de frais :
            if (!$uneFicheFrais) {
                throw $this->createNotFoundException('Fiche introuvable.');
            }

            // On redirige vers la fiche frais
            return $this->redirect($this->generateUrl('ficheFrais_afficher', array('id' => $uneFicheFrais->getId())));
        }


        return $this->render('GestionFraisBundle:Comptable:index.html.twig', array(
            'lesFicheFrais' => $lesFicheFrais,
            'form' => $form->createView(),
        ));
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