<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 04/12/2015
 * Time: 22:02
 */


namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;





class UtilisateurController extends Controller
{
    public function consulterFicheAction($mois)
    {
        $Visiteur = $this->get('security.context')->getToken()->getUser();

        $idVisiteur = $Visiteur->getId();

        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais

        $ficheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(
            array(
                'mois' => $mois,
                'idVisiteur' => $idVisiteur));

        //recupération del'etat de cette fiche

        $etatFicheFrais= $em->getRepository('GestionFraisBundle:EtatFicheFrais')->findBy(
            array(
                'id' => $ficheFrais->getIdEtatFicheFrais(),
            )
        );

        //recupération des frais forfait
        $fraisForfait = $em->getRepository('GestionFraisBundle:FraisForfait')->findAll();


        //recupération des ligne de frais forfait de cette fiche
        $lignesFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(
            array(
                'mois' => $mois,
                'idVisiteur' => $idVisiteur
            )
        );

        //Récupération de l'etat de chaque Ligne

        $etatsligneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findALL();



        //recupération des ligne de frais hors forfait de cette fiche
        $lignesFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findBy(
            array(
                'mois' => $mois,
                'idVisiteur' => $idVisiteur
            )
        );


        //tableau recevant chaque ligne de frais forfait avec comme clef le libelle de son frai
        $tabLigneFraisForfait = array();

        // on parcour les frais forfaits et les lignes de frais forfait pour pouvoir les regrouper sous forme d'un tableau

        foreach($fraisForfait as $frais)
        {
            //on recupere l'id d'un frais
            $idfrais = $frais->getId();

            foreach($lignesFraisForfait as $ligne)
            {
                //si l'id du frais forfait corespond avec l'id du frais forfait
                if($idfrais ==  $ligne->getIdFraisForfait()) {
                    //libellefraos recoit le libelle du frais forfait
                    $libelleFrais = $frais->getLibelleFraisForfait();
                    $tabLigneFraisForfait += array($libelleFrais => $ligne);
                }
            }
        }




        return $this->render('GestionFraisBundle:Utilisateur:consulterFiche.html.twig', array(
            'visiteur'  => $Visiteur,
            'etatLigneFrais' => $etatsligneFrais,
            'ficheFrais'      => $ficheFrais,
            'etatFicheFrais'    => $etatFicheFrais,
            'tabLigneFraisForfait' => $tabLigneFraisForfait,
            'ligneFraisHorsForfait' => $lignesFraisHorsForfait,
            ));

    }









    /**
     * Affiche le contenue d'une fiche de frais et offre la possibilité de la modifier au visiteur
     *
     */
    public function renseignerFicheAction($mois)
    {
        $fichefrais = $this->recupereFicheFrais($mois);

        return $this->render('GestionFraisBundle:FicheFrais:renseignerFiche.html.twig', array(
            'fichefrais'      => $fichefrais));
    }
    /**
     * Affiche le contenue d'une fiche de frais et permet la modification de l'etat au comptable
     *
     */
}