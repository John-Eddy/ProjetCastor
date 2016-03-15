<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 14/12/2015
 * Time: 14:09
 */

namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComptableController extends Controller
{
    public function indexAction(){

        $em = $this->getDoctrine()->getManager();

        //recupération des  fiches frais triées par mois
        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findAll(
            array('datecreation' => 'DESC')
        );

        //création du formulaire de recherche de fiche


        return $this->render('GestionFraisBundle:Comptable:index.html.twig', array(
            'lesFicheFrais' => $lesFicheFrais
        ));
    }
    /*
     * Affiche la fiche frais correspondant au parametres fournis avec la possibilité de modifier l'etat des lignes et de la fiche
     *
     */
    public function validerFicheAction($visiteur, $mois)


    {

    }

}