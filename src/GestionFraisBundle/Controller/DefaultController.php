<?php

namespace GestionFraisBundle\Controller;

use GestionFraisBundle\Entity\Visiteur;
use GestionFraisBundle\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $roles = $this->getUser()->getRoles();

        if(in_array('ROLE_ADMIN',$roles))
        {
            return $this->redirectToRoute('administrateur_index');
        }

        else if (in_array('ROLE_COMPTABLE',$roles))
        {
            return $this->redirectToRoute('comptable_index');
        }
        else
        {
            return $this->redirectToRoute("utilisateur_index");
        }
    }

    public function MofidierMotDePasseAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();//connexion bdd
        $visiteurConnecter = $this->getUser();

        $form = $this->createForm(new VisiteurType(), $visiteurConnecter,array('operation'=>'changerMdp'));
        $form->handleRequest($request);


        if ($form->isValid()) {

            $em->persist($visiteurConnecter);
            $em->flush();

            return $this->redirect($this->generateUrl('Gestion_frais_homepage'));
        }
        return $this->render('GestionFraisBundle:Form:afficherFormulaire.html.twig', array(
            'nomForm' => 'Mofifier mot de passe',
            'role' => $visiteurConnecter->getRoleStr(),
            'form'=>$form->createView()
        ));
    }

    public function MofidierCoordonneeAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();//connexion bdd
        $visiteurConnecter = $this->getUser();

        $form = $this->createForm(new VisiteurType(), $visiteurConnecter,array('operation' => 'changerCoordonnee'));
        $form->handleRequest($request);


        if ($form->isValid()) {

            $em->persist($visiteurConnecter);
            $em->flush();

            return $this->redirect($this->generateUrl('Gestion_frais_homepage'));
        }
        return $this->render('GestionFraisBundle:Form:afficherFormulaire.html.twig', array(
            'nomForm' => 'Mofifier coordonnéés',
            'role' => $visiteurConnecter->getRoleStr(),
            'form'=>$form->createView()
        ));
    }
}
