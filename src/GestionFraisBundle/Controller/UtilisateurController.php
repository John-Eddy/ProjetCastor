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
    /*
     * Récupere les fiche de l'utilisateur conécter depuis la BDD et les affiches par etat
     */
    public function indexAction(){

        $visiteur = $this->get('security.context')->getToken()->getUser();

        $em = $this->getDoctrine()->getManager();

        //recupération des  fiches frais triées par mois

        $ficheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
            array('idVisiteur' => $visiteur->getId()),
            array('mois' => 'DESC')
        );

        //recupération des etats des fiches
        $etatFicheFrais = $em->getRepository('GestionFraisBundle:EtatFicheFrais')->findAll();



        return $this->render('GestionFraisBundle:Utilisateur:index.html.twig', array(
            'ficheFrais' => $ficheFrais,
            'etatFicheFrais' => $etatFicheFrais
        ));
    }

    /*
     * Action consulter de la classe Utilisateur
     *
     * Parametre :
     *  - $mois : chaine de caractère (sous la forme mmaaaa)
     *
     * Cette fonction vérifie si une fiche de frais existe pour l'utilisateur connecté et le mois en paramètre
     *  - si c'est le cas la fonction charges les données de la fiche et le retourne dans la vue "src\GestionFraisBundle\Ressources\views\Utilisateur\consulterFiche.html.twig"
     *  - sinon elle retourne une vue avec le message d'erreur corespondant ( fiche introuvable)
     *
     */
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

        //verification de l'éxistance de la fiche de frais :

        if ($ficheFrais != null)
        {
            //recupération del'etat de cette fiche

            $etatFicheFrais = $em->getRepository('GestionFraisBundle:EtatFicheFrais')->findOneBy(
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


            /* on parcour les frais forfaits et les lignes de frais forfait pour pouvoir les regrouper sous forme d'un tableau
                * la forme du tableau sera :
                *   (
                 *      libelleFrais(String) => ligneFraisForfait(Objet de type LigneFraisForfait),
                 *      libelleFrais2(String) => ligneFraisForfait2(Objet de type LigneFraisForfait),
                 *      ...,
                 * )
                *
                */
            //tableau recevant chaque ligne de frais forfait avec comme clef le libelle de son frais
            $tabLigneFraisForfait = array();

            // on parcour les frais forfaits et les lignes de frais forfait pour pouvoir les regrouper sous forme d'un tableau

            foreach ($fraisForfait as $frais) {
                //on recupere l'id d'un frais
                $idfrais = $frais->getId();


                foreach ($lignesFraisForfait as $ligne) {
                    //si l'id du frais forfait corespond avec l'id du fraisforfait de la ligneFraisForfait
                    if ($idfrais == $ligne->getIdFraisForfait()) {
                        //libellefrais recoit le libelle du frais forfait
                        $libelleFrais = $frais->getLibelleFraisForfait();
                        $tabLigneFraisForfait += array($libelleFrais => $ligne);
                    }
                }
            }


            return $this->render('GestionFraisBundle:Utilisateur:consulterFiche.html.twig', array(
                'visiteur' => $Visiteur,
                'etatLigneFrais' => $etatsligneFrais,
                'ficheFrais' => $ficheFrais,
                'etatFicheFrais' => $etatFicheFrais,
                'tabLigneFraisForfait' => $tabLigneFraisForfait,
                'ligneFraisHorsForfait' => $lignesFraisHorsForfait,
            ));
        }
        //si la fiche n'existe pas
        else{
            $messageEreur = "Aucune fiche n'existe pour le mois : ".$mois;
            return $this->render('GestionFraisBundle:Utilisateur:ficheIntrouvable.html.twig', array(
                'message' => $messageEreur
            ));
        }
    }


    /**
        Action renseigner de la classe Utilisateur
     *
     * Parametre :
     *  - $mois : chaine de caractère (sous la forme mmaaaa)
     *
     * Cette fonction vérifie si une fiche de frais existe pour l'utilisateur connecté et le mois en paramètre
     * Puis elle vérifie que la fiche concerné est modifiable en fonction de son état
     *  - si c'est le cas la fonction charges les données de la fiche et le retourne dans la vue "src\GestionFraisBundle\Ressources\views\Utilisateur\consulterFiche.html.twig"
     *  - sinon elle retourne une vue avec le message d'erreur corespondant ( soit fiche introuvable, soit fiche non modifiale)
     */
    public function renseignerFicheAction($mois)
    {
        $Visiteur = $this->get('security.context')->getToken()->getUser();

        $idVisiteur = $Visiteur->getId();

        $em = $this->getDoctrine()->getManager();


        //recupération de la fiche frais
        $ficheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(
            array(
                'mois' => $mois,
                'idVisiteur' => $idVisiteur));

        if ($ficheFrais != null) {

            //recupération del'etat de cette fiche
            $etatFicheFrais = $em->getRepository('GestionFraisBundle:EtatFicheFrais')->findOneBy(
                array(
                    'id' => $ficheFrais->getIdEtatFicheFrais(),
                )
            );

            //On verifie que l'etat de cette fiche
            if ($etatFicheFrais->getLibelle() == "Fiche créée, saisie en cours") {
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


                //tableau recevant chaque ligne de frais forfait avec comme clef le libelle du frais corespondant a la ligne
                $tabLigneFraisForfait = array();

                /* on parcour les frais forfaits et les lignes de frais forfait pour pouvoir les regrouper sous forme d'un tableau
                * la forme du tableau sera :
                *   (
                 *      libelleFrais(String) => ligneFraisForfait(Objet de type LigneFraisForfait),
                 *      libelleFrais2(String) => ligneFraisForfait2(Objet de type LigneFraisForfait),
                 *      ...,
                 * )
                *
                */
                foreach ($fraisForfait as $frais) {
                    //on recupere l'id d'un frais
                    $idfrais = $frais->getId();

                    foreach ($lignesFraisForfait as $ligne) {
                        //si l'id du frais forfait corespond avec l'id de la ligne de frais forfait
                        if ($idfrais == $ligne->getIdFraisForfait()) {
                            //libellefrais recoit le libelle du frais forfait
                            $libelleFrais = $frais->getLibelleFraisForfait();
                            $tabLigneFraisForfait += array($libelleFrais => $ligne);
                        }
                    }
                }


                return $this->render('GestionFraisBundle:Utilisateur:renseignerFiche.html.twig', array(
                    'visiteur' => $Visiteur,
                    'etatLigneFrais' => $etatsligneFrais,
                    'ficheFrais' => $ficheFrais,
                    'etatFicheFrais' => $etatFicheFrais,
                    'tabLigneFraisForfait' => $tabLigneFraisForfait,
                    'ligneFraisHorsForfait' => $lignesFraisHorsForfait,
                ));
            }
            //si la saisie n'est pas posible
            else
            {
                $messageEreur = "Impossillble de modifier la fiche";
                return $this->render('GestionFraisBundle:Utilisateur:ficheNonModifiable.html.twig', array(
                    'message' => $messageEreur,
                    'action' => "utilisateur_consulter",
                    'mois'=> $mois,
                ));
            }
        }
        //si la fiche n'existe pas
        else{
            $messageEreur = "Aucune fiche n'existe pour le mois : ".$mois;
            return $this->render('GestionFraisBundle:Utilisateur:ficheIntrouvable.html.twig', array(
                'message' => $messageEreur
            ));
        }
    }

}