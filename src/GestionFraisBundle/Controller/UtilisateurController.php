<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 04/12/2015
 * Time: 22:02
 */

namespace GestionFraisBundle\Controller;

use GestionFraisBundle\Entity\FicheFrais;
use GestionFraisBundle\Entity\LigneFraisHorsForfait;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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

        $visiteur = $this->getUser();//Visiteur connecté

        $em = $this->getDoctrine()->getManager();

        //recupération des  fiches frais triées par mois
        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
            array('idvisiteur' => $visiteur->getId()),
            array('datecreation' => 'DESC')
        );


        return $this->render('GestionFraisBundle:Utilisateur\fichefrais:index.html.twig', array(
            "lesFicheFrais" =>$lesFicheFrais,
        ));
    }

    public function ajouterFicheFraisAction()
    {
        $visiteur = $this->getUser();//Visiteur connecté

        $em = $this->getDoctrine()->getManager();

        $gestionaireFiche =$this->container->get('gestionfrais.gestionairefiche');

        //recupération de la derniere fiche frais
        $lesFichesFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findAll(
            array('idvisiteur' => $visiteur->getId()),
            array('datecreation' => 'DESC')
        );
        $derniereFiche = $lesFichesFrais[0];

        if( $derniereFiche == null )
        {
            $nouvelleFicheFrais = $gestionaireFiche->creeFiche($visiteur, $em);// on crée une nouvelle fiche
            return $this->redirect($this->generateUrl('ficheFrais_index'));
        }
        else if(!$gestionaireFiche->estValide($derniereFiche))
        {
            $nouvelleFicheFrais = $gestionaireFiche->creeFiche($visiteur,$em );// on crée une nouvelle fiche
            return $this->redirect($this->generateUrl('ficheFrais_index'));
        }
        else
        {
            return $this->render('GestionFraisBundle:Utilisateur\fichefrais:index.html.twig', array(
                "lesFicheFrais" => $lesFichesFrais,
                "erreurFicheExistante"=>"Une fixe existe déjà pour le mois en cours",
            ));
        }

    }
    public function afficherAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(array(
            'id' => $id));

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais) {
            throw $this->createNotFoundException('Fiche introuvable.');
        }

        //On vérifie que la fiche apartient bien à l'utilisateur connecté
        if($this->getUser()->getId() != $uneFicheFrais->getIdvisiteur()->getId())
        {
            throw $this->createAccessDeniedException('Accès interdit');
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


        if($uneFicheFrais->getIdetatfichefrais()->getLibelle() == "Fiche créée, saisie en cours")
        {
            return $this->render('GestionFraisBundle:Utilisateur/FicheFrais:modifier.html.twig', array(
                'uneFicheFrais' => $uneFicheFrais,
                'lesLignesFraisForfait' => $lesLignesFraisForfait,
                'lesLignesFraisHorsForfait' => $lesLignesFraisHorsForfait,
            ));
        }

        else
        {
            return $this->render('GestionFraisBundle:Utilisateur/FicheFrais:afficher.html.twig', array(
                'uneFicheFrais' => $uneFicheFrais,
                'lesLignesFraisForfait' => $lesLignesFraisForfait,
                'lesLignesFraisHorsForfait' => $lesLignesFraisHorsForfait,
            ));
        }
    }


    /*
     * Fonction qui vérifie les données recupérer depuis la fiche et les enregistre si elle son valide
     */
    public function enregistrerAction($id)
    {

        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneById($id);

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais)
        {
            throw $this->createNotFoundException('Fiche introuvable.');
        }

        //Si l'un des champs n'est pas definit, n'est pas un entier ou est inférieur a 0 on retourne  un message d'erreur
        foreach($_POST as $unId => $uneQuantite)
        {
           // dump($_POST);die();
            if (!isset($_POST[$unId])  ||  $uneQuantite < 0  )
            {
                throw $this->createNotFoundException('Erreur champs.');
            }
        }

        //recupération des ligne de frais forfait de cette fiche
        $lesLignesFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findBy(array('idfichefrais' => $id));

        //On parcourt les ligne frais reccupéré
        foreach($lesLignesFraisForfait as $uneLigneFraisForfait)
        {
            foreach($_POST as $unId => $uneQuantite)// On parcour les données recupéré depuis le formulaire
            {
                if($unId == $uneLigneFraisForfait->getId())//si l'id de la ligne recupéré depuis le formulaire corespond a celui de la ligne de la fiche
                {
                    $uneLigneFraisForfait->setquantite($uneQuantite);//on met a jour la quantité de cette ligne
                    $em->persist($uneLigneFraisForfait);//on enregistre la ligne en base de donnée
                }
            }
        }

        //Modification de la date de modification de la fiche
        $dateActuel = new \DateTime("now");
        $uneFicheFrais->setDateModif( $dateActuel);

        //Enregistrement des la fiche mis a jour en base de donnée
        $em->persist($uneFicheFrais);

        $em->flush();

        return $this->redirectToRoute("ficheFrais_afficher",array(
            'id'=>$uneFicheFrais->getId()
        ));
    }


    Public function ajouterLigneFraisHorsForfaitAction($id, Request $request)
    {

        $idEtatLigneFraisDefaut = 3;
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneById($id);

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais)
        {
            throw $this->createNotFoundException('Fiche introuvable.');
        }

        //On vérifie que la fiche apartient bien à l'utilisateur connecté
        if($this->getUser()->getId() != $uneFicheFrais->getIdvisiteur()->getId())
        {
            throw $this->createAccessDeniedException('Accès interdit');
        }

        //on récupere l'etatLigneFrais "Enregistré"
        $unEtatLigneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findOneById($idEtatLigneFraisDefaut);

        $uneLigneFraisHorsForfait = new LigneFraisHorsForfait();//On créé une nouvelle ligneFraishorsForfait
        $uneLigneFraisHorsForfait->setIdfichefrais($uneFicheFrais);//On attribut cette ligne à la fiche frais
        $uneLigneFraisHorsForfait->setIdetatlignefrais($unEtatLigneFrais);//On lui donne l'etat enregistré
        $uneLigneFraisHorsForfait->setDate(new \DateTime());//on lui passe la date du jour


        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form', $uneLigneFraisHorsForfait);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('date', 'date')
            ->add('montant', 'money')
            ->add('libellelignehorsforfait', 'textarea')
            ->add('file', 'file', array('label' => 'Justificatif', 'required' => true))
            ->add('save', 'submit');
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $uneLigneFraisHorsForfait contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid())
        {
            $em->persist($uneLigneFraisHorsForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $uneLigneFraisHorsForfait->sauvgarderFichier();//fonction qui deplace le justificatif pour le conservé

            $em->persist($uneLigneFraisHorsForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');

            // On redirige vers la fiche frais
            return $this->redirect($this->generateUrl('ficheFrais_afficher', array('id' => $id)));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('GestionFraisBundle:Utilisateur/LigneFraisHorsForfait:ajouter.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function afficherLigneFraisHorsForfaitAction($id)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneLigneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneLigneFraisHorsForfait)
        {
            throw $this->createNotFoundException('Frais hors forfait introuvable.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        if($this->getUser()->getId() != $uneLigneFraisHorsForfait->getIdfichefrais()->getIdvisiteur()->getId())
        {
            throw $this->createAccessDeniedException('Accès interdit');
        }

        return $this->render('GestionFraisBundle:Utilisateur/LigneFraisHorsForfait:afficher.html.twig', array(
            'uneLigneFraisHorsForfait' => $uneLigneFraisHorsForfait,
        ));


    }
    public function modifierLigneFraisHorsForfaitAction($id, Request $request)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneLigneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneLigneFraisHorsForfait)
        {
            throw $this->createNotFoundException('Frais hors forfait introuvable.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        if($this->getUser()->getId() != $uneLigneFraisHorsForfait->getIdfichefrais()->getIdvisiteur()->getId())
        {
            throw $this->createAccessDeniedException('Accès interdit');
        }

        // On crée le FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form', $uneLigneFraisHorsForfait);

        // On ajoute les champs de l'entité que l'on veut à notre formulaire
        $formBuilder
            ->add('date', 'date')
            ->add('montant', 'money')
            ->add('libellelignehorsforfait', 'textarea')
            ->add('file', 'file', array('label' => 'Justificatif', 'required' => false))
            ->add('save', 'submit');
        // Pour l'instant, pas de candidatures, catégories, etc., on les gérera plus tard

        // À partir du formBuilder, on génère le formulaire
        $form = $formBuilder->getForm();

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $uneLigneFraisHorsForfait contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid())
        {
            if(isset($uneLigneFraisHorsForfait->file))
            {
                unlink($uneLigneFraisHorsForfait->getJustificatif());
                $uneLigneFraisHorsForfait->sauvgarderFichier();//fonction qui deplace le justificatif pour le conservé
            }

            $em->persist($uneLigneFraisHorsForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');

            // On redirige vers la fiche frais
            return $this->redirect($this->generateUrl('ficheFrais_afficher', array('id' => $uneLigneFraisHorsForfait->getIdfichefrais()->getId())));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('GestionFraisBundle:Utilisateur\LigneFraisHorsForfait:modifier.html.twig', array(
            'form' => $form->createView(),
            'ligneFraisHF'=>$uneLigneFraisHorsForfait,
        ));
    }

    public function supprimerLigneFraisHorsForfaitAction($id)
    {
        //Conection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneLigneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneLigneFraisHorsForfait)
        {
            throw $this->createNotFoundException('Frais hors forfait introuvable.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        if($this->getUser()->getId() != $uneLigneFraisHorsForfait->getIdfichefrais()->getIdvisiteur()->getId())
        {
            throw $this->createAccessDeniedException('Accès interdit');
        }

        //On enregistre l'id de la ficheFrais avant de suprimer la ligne pour pouvoir rediriger vers la ficheFrais
        $idFicheFrais = $uneLigneFraisHorsForfait->getIdfichefrais()->getId();

        //Si le fichier joint exister
        if(is_file($uneLigneFraisHorsForfait->getJustificatif()))
        {
            unlink($uneLigneFraisHorsForfait->getJustificatif());//on supprime le
            rmdir($uneLigneFraisHorsForfait->getUploadDir());//on supprime le répértoire
        }
        $em->remove($uneLigneFraisHorsForfait);//on supprime la ligneFraisHF
        $em->flush();

        //on redirige vers la ficheFrais
        return $this->redirect($this->generateUrl('ficheFrais_afficher', array('id' => $idFicheFrais)));

    }
}
