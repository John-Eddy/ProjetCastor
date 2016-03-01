<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 04/12/2015
 * Time: 22:02
 */



namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GestionFraisBundle\Utils;
use Symfony\Component\Validator\Constraints\DateTime;

class UtilisateurController extends Controller
{
    /*
     * Récupere les fiche de l'utilisateur connecté et tout les etat de la table etatFicheFrais
     *  depuis la BDD et les transmet a la vue Utilisateur:index.html.twig
     *
     */
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(){

        $visiteur = $this->get('security.context')->getToken()->getUser();//Visiteur connecté

        $em = $this->getDoctrine()->getManager();

        //recupération des  fiches frais triées par mois
        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
            array('idvisiteur' => $visiteur->getId()),
            array('datemodif' => 'DESC')
        );

        //Recupération de toutes les colone de la table etatFicheFrais
        $lesEtatFicheFrais = $em->getRepository('GestionFraisBundle:EtatFicheFrais')->findAll();

        return $this->render('GestionFraisBundle:Utilisateur\fichefrais:index.html.twig', array(
            "lesFicheFrais" =>$lesFicheFrais,
        ));
    }

    /*
     * Action consulter de la classe Utilisateur
     *
     * Parametre :
     *  - $mois : chaine de caractère (sous la forme mmaaaa)
     *
     * Cette fonction vérifie si une fiche de frais existe pour l'utilisateur connecté et le mois en paramètre
     *  - si c'est le cas la fonction charges les données de la fiche et le retourne dans la vue "src\GestionFraisBundle\Ressources\views\Utilisateur\consulter.html.twig"
     *  - sinon elle retourne une vue avec le message d'erreur corespondant ( fiche introuvable)
     *
     */
    public function consulterAction($id)
    {

        $em = $this->getDoctrine()->getManager();


        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneById($id);


        //verification de l'éxistance de la fiche de frais :
        if( !$uneFicheFrais)
        {
            throw $this->createNotFoundException('Fiche introuvable.');
        }


        //recupération des ligne de frais forfait de cette fiche
        $lesLignesFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(
            array(
                'idfichefrais' => $id,
            )
        );


        //recupération des ligne de frais hors forfait de cette fiche
        $lesLignesFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findBy(
            array(
                'idfichefrais' => $id,
            )
        );



        return $this->render('GestionFraisBundle:Utilisateur\fichefrais:consulter.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
            'lesLignesFraisForfait' => $lesLignesFraisForfait,
            'lesLignesFraisHorsForfait' => $lesLignesFraisHorsForfait,
        ));
    }


    /**
        Action renseigner de la classe Utilisateur
     *
     * Parametre :
     *  - $mois : chaine de caractère (sous la forme mmaaaa)
     *
     * Cette fonction vérifie si une fiche de frais existe pour l'utilisateur connecté et le mois en paramètre
     * Puis elle vérifie que la fiche concerné est modifiable en fonction de son état
     *  - si c'est le cas la fonction charges les données de la fiche et le retourne dans la vue "src\GestionFraisBundle\Ressources\views\Utilisateur\consulter.html.twig"
     *  - sinon elle retourne une vue avec le message d'erreur corespondant ( soit fiche introuvable, soit fiche non modifiale)
     */
    public function renseignerAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(array(
            'id' => $id));

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais) {
            throw $this->createNotFoundException('Fiche introuvable.');
        }

        //recupération du visiteur de cette fiche
        $visiteurFiche = $em->getRepository('GestionFraisBundle:Visiteur')->findOneBy(
            array(
                'id' => $id,
            )
        );

        //recupération del'etat de cette fiche
        $etatFicheFrais = $em->getRepository('GestionFraisBundle:EtatFicheFrais')->findOneBy(
            array('id' => $uneFicheFrais->getIdEtatFicheFrais())
        );

        //On verifie que l'etat de cette fiche permet la modification par l'utlisateur
        if ($etatFicheFrais->getLibelle() != "Fiche créée, saisie en cours") {
            throw $this->createAccessDeniedException('Modification impossible');
        }

        //recupération des ligne de frais forfait de cette fiche
        $lesLignesFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(
            array(
                'idfichefrais' => $id,
            )
        );


        //recupération des ligne de frais hors forfait de cette fiche
        $lesLignesFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findBy(
            array(
                'idfichefrais' => $id,
            )
        );



        return $this->render('GestionFraisBundle:Utilisateur:fichefrais\renseigner.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
            'lesLignesFraisForfait' => $lesLignesFraisForfait,
            'lesLignesFraisHorsForfait' => $lesLignesFraisHorsForfait,
        ));

    }

    /*
     * Fonction qui vérifie les données recupérer depuis la fiche et les enregistre si elle son valide
     */
    public function enregistrerAction($id)
    {

        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        $lesTypeDeFraisForfait = $em->getRepository('GestionFraisBundle:FraisForfait')->findAll();

        //Si l'un des champs Killometres ou Repas_Midi ou Nuitée n'est pas definit on retourne a la fiche avec un message d'erreur
        foreach($_POST as $unId => $uneQuantite)
        {
            if (!isset($_POST[$unId]) )
            {
                throw $this->createNotFoundException('Erreur Champs.');
            }
        }


        //recupération des ligne de frais forfait de cette fiche
        $lesLignesFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(array('idfichefrais' => $id));

        //On parcourt les ligne frais reccupéré
        foreach($lesLignesFraisForfait as $uneLigneFraisForfait)
        {
            foreach($_POST as $unId => $uneQuantite)// On parcour les donnée recupérer depuis le formulair
            {
                if($unId == $uneLigneFraisForfait->getId())//si l'id de la ligne recupéré depuis  le formulaire corespond a celui de la ligne
                {
                    $uneLigneFraisForfait->setquantite($uneQuantite);//on met a jour la quantité de cette ligne
                    $em->persist($uneLigneFraisForfait);//on enregistre la ligne en base de donnée
                }
            }
        }


        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneById($id);

        //Modification de la date de modification de la fiche
        $dateActuel = new \DateTime("now");
        $uneFicheFrais->setDateModif( $dateActuel);

        //Enregistrement des la fiche mis a jour en base de donnée
        $em->persist($uneFicheFrais);

        $em->flush();

        return $this->redirectToRoute("ficheFrais_renseigner",array(
            'id'=>$uneFicheFrais->getId()
        ));
    }


    Public function nouvelleLigneFraisHorsForfait($id)
    {

    }
}
