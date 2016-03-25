<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 04/12/2015
 * Time: 22:02
 */

namespace GestionFraisBundle\Controller;

use Doctrine\DBAL\Exception\DatabaseObjectNotFoundException;
use GestionFraisBundle\Entity\FicheFrais;
use GestionFraisBundle\Entity\LigneFraisForfait;
use GestionFraisBundle\Entity\LigneFraisHorsForfait;
use GestionFraisBundle\Entity\Visiteur;
use GestionFraisBundle\Form\LigneFraisHorsForfaitType;
use GestionFraisBundle\Form\LigneFraisForfaitType;
use GestionFraisBundle\Form\RechercherFicheFraisType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class UtilisateurController extends Controller
{

    public function saisirFraisAction()
    {
        $visiteurConnecter = $this->getUser();//Visiteur connecté
        $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche

        $em = $this->getDoctrine()->getManager();//connexion bdd
        $uneFicheFrais = $gestionaireFiche->getDerniereFicheFraisValide($visiteurConnecter, $em);
        $uneFicheFrais = $gestionaireFiche->chargerLignesFrais($uneFicheFrais,$em);

        return $this->render('GestionFraisBundle:Utilisateur/FicheFrais:modifier.html.twig', array(
            'uneFicheFrais' => $uneFicheFrais,
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
    public function RercherFicheFraisAction(Request $request)
    {
        $visiteur = $this->getUser();//Visiteur connecté

        $em = $this->getDoctrine()->getManager();

        //recupération des  fiches frais triées par mois
        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findBy(
            array('idvisiteur' => $visiteur->getId()),
            array('datecreation' => 'DESC')
        );

        // À partir du formBuilder, on génère le formulaire
        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(new RechercherFicheFraisType());

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $valeurForm contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {

            //On récupere la date du formulaire et on la transforme en chaine de caractères
            $criteres['idvisiteur'] =$visiteur->getId();
            $dateForm = date_format($form->getData()['mois'], 'Y-m-d H:i:s');

            if($form->getData()['mois'])
            {
                $mois = substr($dateForm, 5, 2);
                $annee =substr($dateForm, 0, 4); // on extrait le mois et l'année de la chaine et on les mets au format mmaaaa
                $criteres['mois']= $mois;
                $criteres['annee'] =$annee;
                }
                //recupération de la  fiches frais corespondant au mois
                $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy($criteres);

                //verification de l'éxistance de la fiche de frais :
                if (!$uneFicheFrais) {
                    throw new NotFoundHttpException('Fiche introuvable.');
                }

                // On redirige vers la fiche frais
                return $this->redirect($this->generateUrl('utilisateur_afficherFiche', array('id' => $uneFicheFrais->getId())));
            }

        return $this->render('GestionFraisBundle:Utilisateur\fichefrais:rechercher.html.twig', array(
            "lesFicheFrais" => $lesFicheFrais,
            'form' => $form->createView(),
        ));
    }

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function afficherFicheFraisAction($id)
    {
        $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneBy(array(
            'id' => $id));

        //verification de l'éxistance de la fiche de frais :
        if (!$uneFicheFrais) {
            throw new DatabaseObjectNotFoundException('Cette fiche n\'existe pas.');
        }
        //On vérifie que la fiche apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneFicheFrais->getIdvisiteur()->getId()) {
            throw new AccessDeniedException('Impossible d’accéder à cette fiche.');
        }

        $uneFicheFrais = $gestionaireFiche->chargerLignesFrais($uneFicheFrais, $em);

            return $this->render('GestionFraisBundle:Utilisateur/FicheFrais:afficher.html.twig', array(
                'uneFicheFrais' => $uneFicheFrais,
            ));

    }

    Public function ajouterligneFraisForfaitAction($id, Request $request)
    {
        $idEtatLigneFraisDefaut = $this->container->getParameter('idEtatLigneFraisDefaut');

        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //recupération de la fiche frais
        $uneFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findOneById($id);

        //verification de l'éxistance de la fiche de frais :
        if ($uneFicheFrais == null) {
            throw new AccessDeniedException('Impossible d\'ajouter un frais forfait à cette fiche.');
        }
        //On vérifie que la fiche apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneFicheFrais->getIdvisiteur()->getId()) {
            throw new AccessDeniedException('Impossible d\'ajouter un frais forfait à cette fiche.');
        }

        //on récupere l'etatLigneFrais "Enregistré"
        $unEtatLigneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findOneById($idEtatLigneFraisDefaut);

        $uneligneFraisForfait = new LigneFraisForfait();//On créé une nouvelle ligneFraisForfait
        $uneligneFraisForfait->setIdfichefrais($uneFicheFrais);//On attribut cette ligne à la fiche frais
        $uneligneFraisForfait->setIdetatlignefrais($unEtatLigneFrais);//On lui donne l'etat enregistré
        $uneligneFraisForfait->setDate(new \DateTime());//on lui passe la date du jour


        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(new ligneFraisForfaitType,$uneligneFraisForfait,array('role'=> 'utilisateur', 'action' => 'modifier'));

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $uneligneFraisForfait contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont co
        //rrectes
        if ($form->isValid()) {
            dump($id);
            dump($uneFicheFrais);die();
            //Calcul du montant de la ligne
            $montantLigne = $uneligneFraisForfait->getQuantite()*$uneligneFraisForfait->getIdfraisforfait()->getMontant();
            $uneligneFraisForfait->setMontant($montantLigne);
            $em->persist($uneligneFraisForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');
            // On redirige vers la fiche frais
            dump($uneligneFraisForfait);die();
            //$this->forward('GestionFraisBundle:Utilisateur:saisirFrais',array('id'=>$uneligneFraisForfait->getIdfichefrais()->getId()));
            return $this->redirect($this->generateUrl('utilisateur_saisirFrais', array('id' => $uneligneFraisForfait->getIdfichefrais()->getId())));
        }

        return $this->render('GestionFraisBundle:Utilisateur/lignefraisforfait:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function modifierligneFraisForfaitAction($id, Request $request)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneligneFraisForfait = $em->getRepository('GestionFraisBundle:ligneFraisForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneligneFraisForfait) {
            $this->erreurAction('Ce frais forfait n\'existe pas.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneligneFraisForfait->getIdfichefrais()->getIdvisiteur()->getId()) {
            $this->erreurAction('Impossible d’accéder à ce frais forfait.');
        }

        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(new ligneFraisForfaitType($uneligneFraisForfait, null, array('role'=> 'utilisateur','action' => 'modifier')));

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $uneligneFraisForfait contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {

            $montantLigne = $uneligneFraisForfait->getQuantite()*$uneligneFraisForfait->getIdfraisforfait()->getMontant();
            $uneligneFraisForfait->setMontant($montantLigne);

            $em->persist($uneligneFraisForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');

            // On redirige vers la fiche frais
            return $this->redirect($this->generateUrl('utilisateur_saisirFrais', array('id' => $uneligneFraisForfait->getIdfichefrais()->getId())));
        }

        // À ce stade, le formulaire n'est pas valide car :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire contient des valeurs invalides, donc on l'affiche de nouveau
        // On passe la méthode createView() du formulaire à la vue
        // afin qu'elle puisse afficher le formulaire toute seule
        return $this->render('GestionFraisBundle:Utilisateur\lignefraisforfait:form.html.twig', array(
            'form' => $form->createView(),
            'ligneFraisHF' => $uneligneFraisForfait,
        ));
    }

    public function afficherligneFraisForfaitAction($id, Request $request)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneligneFraisForfait = $em->getRepository('GestionFraisBundle:ligneFraisForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneligneFraisForfait) {
            $this->erreurAction('Ce frais hors forfait n\'existe pas.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneligneFraisForfait->getIdfichefrais()->getIdvisiteur()->getId()) {
            $this->erreurAction('Impossible d’accéder à ce frais hors forfait.');
        }

        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(new ligneFraisForfaitType($uneligneFraisForfait, null, array('role'=> 'utilisateur','action' => 'consulter')));

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        // À partir de maintenant, la variable $uneligneFraisForfait contient les valeurs entrées dans le formulaire par le visiteur

        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {
            return $this->redirect($this->generateUrl('utilisateur_saisirFrais', array('id' => $uneligneFraisForfait->getIdfichefrais()->getId())));
        }

        return $this->render('GestionFraisBundle:Utilisateur/ligneFraisForfait:afficher.html.twig', array(
            'form' => $form,
        ));
    }

    public function supprimerligneFraisForfaitAction($id)
    {
        //Conection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneligneFraisForfait = $em->getRepository('GestionFraisBundle:LigneFraisForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneligneFraisForfait) {
            $this->erreurAction('Ce frais forfait n\'existe pas.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneligneFraisForfait->getIdfichefrais()->getIdvisiteur()->getId()) {
            $this->erreurAction('Impossible d’accéder à ce frais forfait.');
        }

        //On enregistre l'id de la ficheFrais avant de suprimer la ligne pour pouvoir rediriger vers la ficheFrais
        $idFicheFrais = $uneligneFraisForfait->getIdfichefrais()->getId();

        //Si le fichier joint exister
        $em->remove($uneligneFraisForfait);//on supprime la ligneFraisforfait
        $em->flush();

        //on redirige vers la ficheFrais
        return $this->redirect($this->generateUrl('utilisateur_saisirFrais', array('id' => $idFicheFrais)));
    }

    Public function ajouterLigneFraisHorsForfaitAction(Request $request)
    {
        $idEtatLigneFraisDefaut = $this->container->getParameter('idEtatLigneFraisDefaut');
        $gestionaireFiche = $this->container->get('gestion_frais.gestionairefiche');//recuperation du service gestionaire de fiche

        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        $visiteurConnecter = $this->getUser();//Visiteur connecté

        //on récupere l'etatLigneFrais "Enregistré"
        $unEtatLigneFrais = $em->getRepository('GestionFraisBundle:EtatLigneFrais')->findOneById($idEtatLigneFraisDefaut);
        $uneLigneFraisHorsForfait = new LigneFraisHorsForfait();//On créé une nouvelle ligneFraishorsForfait
        $uneLigneFraisHorsForfait->setIdetatlignefrais($unEtatLigneFrais);//On lui donne l'etat enregistré
        $uneLigneFraisHorsForfait->setIdfichefrais($gestionaireFiche->getDerniereFicheFraisValide($visiteurConnecter, $em));//On attribut cette ligne à la fiche frais

        $optionForm = array('visiteur'=> 'utilisateur', 'action' => 'ajouter');
        // À partir du formBuilder, on génère le formulaire
        $form = $this->createForm(new LigneFraisHorsForfaitType,$uneLigneFraisHorsForfait,array('role'=> 'utilisateur', 'action' => 'ajouter'));
        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em->persist($uneLigneFraisHorsForfait);//On enregistre la ligne la ligne frais
            $em->flush();
            //$uneLigneFraisHorsForfait->sauvgarderFichier();//fonction qui deplace le justificatif pour le conservé
            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');
            // On redirige vers la fiche frais
            return $this->redirect($this->generateUrl('utilisateur_saisirFrais'));
        }

        return $this->render('GestionFraisBundle:Utilisateur/lignefraishorsforfait:form.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    public function modifierLigneFraisHorsForfaitAction($id, Request $request)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneLigneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (null == $uneLigneFraisHorsForfait) {
            $this->erreurAction('Ce frais hors forfait n\'existe pas.');
        } //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneLigneFraisHorsForfait->getIdfichefrais()->getIdvisiteur()->getId()) {
            $this->erreurAction('Impossible d’accéder à ce frais hors forfait.');
        }

        $optionForm = array('role' => 'utilisateur', 'action' => 'modifier');

        $form = $this->createForm(new LigneFraisHorsForfaitType, $uneLigneFraisHorsForfait, $optionForm);

        // On fait le lien Requête <-> Formulaire
        $form->handleRequest($request);
        // On vérifie que les valeurs entrées sont correctes
        if ($form->isValid()) {

           /* if (isset($uneLigneFraisHorsForfait->file)) {
                unlink($uneLigneFraisHorsForfait->getJustificatif());
                $uneLigneFraisHorsForfait->sauvgarderFichier();//fonction qui deplace le justificatif pour le conservé
            }*/
            $em->persist($uneLigneFraisHorsForfait);//On enregistre la ligne la ligne frais
            $em->flush();

            $request->getSession()->getFlashBag()->add('notice', 'Frais bien enregistrée.');

            // On redirige vers la fiche frais
            return $this->redirect($this->generateUrl('utilisateur_saisirFrais'));
        }
        return $this->render('GestionFraisBundle:Utilisateur\LigneFraisHorsForfait:form.html.twig', array(
            'form' => $form->createView(),
            'ligneFraisHF' => $uneLigneFraisHorsForfait,
        ));
    }

    public function afficherLigneFraisHorsForfaitAction($id)
    {
        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneLigneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneLigneFraisHorsForfait) {
            $this->erreurAction('Ce frais hors forfait n\'existe pas.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
       elseif ($this->getUser()->getId() != $uneLigneFraisHorsForfait->getIdfichefrais()->getIdvisiteur()->getId()) {
            $this->erreurAction('Impossible d’accéder à ce frais hors forfait.');
       }

        return $this->render('GestionFraisBundle:Utilisateur/LigneFraisHorsForfait:afficher.html.twig', array(
            'uneLigneFraisHorsForfait' => $uneLigneFraisHorsForfait,
        ));
    }

    public function supprimerLigneFraisHorsForfaitAction($id)
    {
        //Conection BDD
        $em = $this->getDoctrine()->getManager();

        //On récupère la ligneFraisHF
        $uneLigneFraisHorsForfait = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findOneById($id);

        //verification de l'éxistance de la ligneFraisHF :
        if (!$uneLigneFraisHorsForfait) {
            throw new DatabaseObjectNotFoundException('Ce frais hors forfait n\'existe pas.');
        }

        //On vérifie que la ligneFraisHF apartient bien à l'utilisateur connecté
        elseif ($this->getUser()->getId() != $uneLigneFraisHorsForfait->getIdfichefrais()->getIdvisiteur()->getId()) {
            throw new AccessDeniedException('Impossible d’accéder à ce frais hors forfait.');
        }

        //On enregistre l'id de la ficheFrais avant de suprimer la ligne pour pouvoir rediriger vers la ficheFrais
        $idFicheFrais = $uneLigneFraisHorsForfait->getIdfichefrais()->getId();

        //Si le fichier joint exister
        $em->remove($uneLigneFraisHorsForfait);//on supprime la ligneFraisHF
        $em->flush();

        //on redirige vers la ficheFrais
        return $this->redirect($this->generateUrl('utilisateur_saisirFrais', array('id' => $idFicheFrais)));
    }
}