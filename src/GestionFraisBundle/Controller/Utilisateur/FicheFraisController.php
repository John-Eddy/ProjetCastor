<?php

/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 26/02/2016
 * Time: 21:33
 */
class FicheFraisController
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

        $lesFicheFraisCompletes = array();

        foreach($lesFicheFrais as $uneFicheFrais)
        {
            $uneFicheFraisComplete = new FicheFraisComplete();

            $uneFicheFraisComplete->setFicheFrais($uneFicheFrais);
            $uneFicheFraisComplete->setVisiteur($visiteur);

            foreach( $lesEtatFicheFrais as $unEtatFicheFrais )
            {
                $a = $unEtatFicheFrais->getId();
                $b = $uneFicheFrais->getIdetatfichefrais();

                if( $a)
                {
                    $uneFicheFraisComplete->setEtatFicheFrais($unEtatFicheFrais);
                }
            }
            array_push($lesFicheFraisCompletes, $uneFicheFraisComplete);
        }
        return $this->render('GestionFraisBundle:Utilisateur:index.html.twig', array(
            "lesFicheFraisCompletes" => $lesFicheFraisCompletes,
            "fiche" =>$lesFicheFrais,
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
    public function showFicheAction($id)
    {

        $em = $this->getDoctrine()->getManager();


        //recupération de la fiche frais
        $ficheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneById($id);


        //verification de l'éxistance de la fiche de frais :
        if( !$ficheFrais)
        {
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
            array(
                'id' => $ficheFrais->getIdEtatFicheFrais(),
            )
        );

        $lesLigneFraisForfait = $this->getLigneFraisForfait($id);

        $lesLigneFraisHorsForfait = $this ->getLigneFraisHorsForfait($id);




        return $this->render('GestionFraisBundle:Utilisateur:consulter.html.twig', array(
            'visiteur' => $visiteurFiche,
            'ficheFrais' => $ficheFrais,
            'etatFicheFrais' => $etatFicheFrais,
            'lesLigneFraisForfait' => $lesLigneFraisForfait,
            'lesLigneFraisHorsForfait' => $lesLigneFraisHorsForfait,
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
    public function editFicheAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $ficheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneById($id);

        //verification de l'éxistance de la fiche de frais :
        if (!$ficheFrais) {
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
            array('id' => $ficheFrais->getIdEtatFicheFrais())
        );

        //On verifie que l'etat de cette fiche permet la modification par l'utlisateur
        if ($etatFicheFrais->getLibelle() != "Fiche créée, saisie en cours") {
            throw $this->createAccessDeniedException('Modification impossible');
        }

        //recupération des ligne de frais forfait de cette fiche
        $lesLigneFraisForfait = $this->getLigneFraisForfait($id);

        //recupération des ligne de frais hors forfait de cette fiche
        $lesLigneFraisHorsForfait = $this->getLigneFraisHorsForfait($id);


        return $this->render('GestionFraisBundle:Utilisateur:renseigner.html.twig', array(
            'visiteur' => $visiteurFiche,
            'ficheFrais' => $ficheFrais,
            'etatFicheFrais' => $etatFicheFrais,
            'lesLigneFraisForfait' => $lesLigneFraisForfait,
            'lesLigneFraisHorsForfait' => $lesLigneFraisHorsForfait,
        ));

    }

    /*
     * Fonction qui vérifie les données recupérer depuis la fiche et les enregistre si elle son valide
     */
    public function updateAction($id)
    {

        //Si l'un des champs Killometres ou Repas_Midi ou Nuitée n'est pas definit on retourne a la fiche avec un message d'erreur
        if(!isset($_POST["Kilometres"]) || !isset($_POST["Repas_Midi"]) || !isset($_POST["Nuitée"]) )
        {
            $messageEreur = "Erreur certains champs n'ont pas été renseigné";
            return $this->render('GestionFraisBundle:Utilisateur:champNonRenseigner.html.twig', array(
                'message' => $messageEreur,
                'action' => "utilisateur_renseigner",
            ));
        }
        else{
            //On recupère les information du visiteur connécter
            $Visiteur = $this->get('security.context')->getToken()->getUser();
            //Récuperation de l'id du viisiteur
            $idVisiteur = $Visiteur->getId();

            //Connection BDD
            $em = $this->getDoctrine()->getManager();

            //recupération de la fiche frais
            $ficheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(
                array(
                    'mois' => $mois,
                    'idVisiteur' => $idVisiteur));
            //Modification de la date de modification de la fiche
            //$ficheFrais->setDateModif();

            //récupération des frais forfait
            $fraisForfait = $em->getRepository('GestionFraisBundle:FraisForfait')->findAll();
            $tabFraisForfait= array();
            foreach($fraisForfait as $value)
            {
                $tabFraisForfait[$value->getLibelle()] = $value->getId();
            }

            $lignesFraisForfait = array();
            $lignesFraisHorsForfait = array();


            //Séparation des Ligne de frais forfait et des ligne de frais hors forfaits dans deux tableau
            foreach ($_POST as $clef => $valeur)
            {
                if( $clef == 'date' || $clef == 'montant'|| $clef == 'libelle')
                {
                    $lignesFraisHorsForfait[$clef]=$valeur;
                }
                else
                {
                    $lignesFraisForfait[$clef] = $valeur;
                }
            }
            foreach($lignesFraisForfait as $clef => $value )
            {

            }

            return $this->render('GestionFraisBundle:Utilisateur:vueTest.html.twig', array(
                'lignesFraisForfait' => $lignesFraisForfait,
                'lignesFraisHorsForfait' => $lignesFraisHorsForfait,
            ));
        }


    }

    /* Fonction qui regroupe les lignes de frais forfait avec leur etat et leur type de frais dans un objet de la classe

    GestionFraisBundle/Utils/LigneFraisForfaitComplete

    retourne un tableau de LigneFraisForfaitComplete

    */

    public function getLigneFraisForfait($id)
    {
        $em = $this->getDoctrine()->getManager();


        //recupération des ligne de frais forfait de cette fiche
        $lesLignesFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(
            array(
                'idFicheFrais' => $id,
            )
        );

        //recupération des fraisForfait
        $lesTypeDeFraisForfaits = $em->getRepository('GestionFraisBundle:FraisForfait')->findAll();

        //Récupération des etatLigneFrais
        $lesEtatsLigneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findALL();


        //On créés le tableau recevant chaque LigneFraisForfaitComplette
        $lesLigneFraisForfaitComplete = array();

        //On créé un objet de type LigneFraisForfaitComplette vide
        $uneLigneFraisForfaitComplete = new LigneFraisForfaitComplete();


        foreach ($lesLignesFraisForfait as $uneLigneFraisForfait)// On parcour les lignes de frais forfait
        {
            $uneLigneFraisForfaitComplete->setLigneFraisForfait($uneLigneFraisForfait);//on ajoute la ligneFraisForfait à l'objet

            foreach($lesTypeDeFraisForfaits as $unTypeDeFraisForfait)//on parcour les type de frais forfait
            {
                if($unTypeDeFraisForfait->getId() == $uneLigneFraisForfait->getIdfraisforfait()) // si le type de frais corespond a celui de la ligne
                {
                    $uneLigneFraisForfaitComplete->setFraisForfait($unTypeDeFraisForfait);//on ajoute le type de frais Forfait à l'objet
                }
            }

            foreach($lesEtatsLigneFrais as $unEtatLigneFrais)//on parcour les etat de ligne possible
            {
                if($unEtatLigneFrais->getId() == $uneLigneFraisForfait->getIdetatlignefrais()) // si l'etat corespond a celui de la ligne
                {
                    $uneLigneFraisForfaitComplete->setEtatLigneFrais($unEtatLigneFrais);//on ajoute l'etat à l'objet
                }
            }

            $lesLigneFraisForfaitComplete += $uneLigneFraisForfaitComplete;//on ajoute l'objet au tableau
        }
        return $lesLigneFraisForfaitComplete;
    }

    public function getLigneFraisHorsForfait($id)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération des ligne de frais hors forfait de la fiche
        $lesLignesFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findBy(
            array('idFicheFrais' => $id)
        );

        //Récupération des etatLigneFrais
        $lesEtatsLigneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findALL();

        //On créés le tableau recevant chaque LigneFraisForfaitComplette
        $lesLigneFraisHorsForfaitComplete = array();

        //On créé un objet de type LigneFraisForfaitComplette vide
        $uneLigneFraisHorsForfaitComplete = new LigneFraisHorsForfaitComplete();

        foreach ($lesLignesFraisHorsForfait as $uneLigneFraisHorsForfait)// On parcour les lignes de frais Hors forfait
        {
            $uneLigneFraisHorsForfaitComplete->setLigneFraisHorsForfait($uneLigneFraisHorsForfait);//on ajoute la ligneFraisHorsForfait à l'objet

            foreach ($lesEtatsLigneFrais as $unEtatLigneFrais)//on parcour les etat de ligne possible
            {
                if ($unEtatLigneFrais->getId() == $uneLigneFraisHorsForfait->getIdetatlignefrais()) // si l'etat corespond a celui de la ligne
                {
                    $uneLigneFraisHorsForfaitComplete->setEtatLigneFrais($unEtatLigneFrais);//on ajoute l'etat à l'objet
                }
            }
        }
        return $lesLigneFraisHorsForfaitComplete;
    }

}
class FicheFraisComplete
{


    private $visiteur;
    private $ficheFrais;
    private $etatFicheFrais;
    private $lesLigneFraisForfait = array();
    private $lesLigneFraisHorsForfait = array();

    /**
     * FicheCompete constructor.
     * @param $visiteur
     * @param $ficheFrais
     * @param array $lesLigneFraisHorsForfait
     * @param array $lesLigneFraisForfait
     * @param $etatFicheFrais
     */
    public function __construct()
    {
        $this->visiteur = null;
        $this->ficheFrais = null;
        $this->lesLigneFraisHorsForfait = null;
        $this->lesLigneFraisForfait = null;
        $this->etatFicheFrais = null;
    }

    /**
     * @return mixed
     */
    public function getVisiteur()
    {
        return $this->visiteur;
    }

    /**
     * @param mixed $visiteur
     */
    public function setVisiteur($visiteur)
    {
        $this->visiteur = $visiteur;
    }

    /**
     * @return mixed
     */
    public function getFicheFrais()
    {
        return $this->ficheFrais;
    }

    /**
     * @param mixed $ficheFrais
     */
    public function setFicheFrais($ficheFrais)
    {
        $this->ficheFrais = $ficheFrais;
    }

    /**
     * @return mixed
     */
    public function getEtatFicheFrais()
    {
        return $this->etatFicheFrais;
    }

    /**
     * @param mixed $etatFicheFrais
     */
    public function setEtatFicheFrais($etatFicheFrais)
    {
        $this->etatFicheFrais = $etatFicheFrais;
    }

    /**
     * @return array
     */
    public function getLesLigneFraisForfait()
    {
        return $this->lesLigneFraisForfait;
    }

    /**
     * @param array $lesLigneFraisForfait
     */
    public function setLesLigneFraisForfait($lesLigneFraisForfait)
    {
        $this->lesLigneFraisForfait = $lesLigneFraisForfait;
    }

    /**
     * @return array
     */
    public function getLesLigneFraisHorsForfait()
    {
        return $this->lesLigneFraisHorsForfait;
    }

    /**
     * @param array $lesLigneFraisHorsForfait
     */
    public function setLesLigneFraisHorsForfait($lesLigneFraisHorsForfait)
    {
        $this->lesLigneFraisHorsForfait = $lesLigneFraisHorsForfait;
    }

}