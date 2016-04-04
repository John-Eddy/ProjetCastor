<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 17/03/2016
 * Time: 20:15
 */


namespace GestionFraisBundle\Controller;

use GestionFraisBundle\Entity\Visiteur;
use GestionFraisBundle\Form\VisiteurType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class TestController extends Controller
{
    public function testAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();//connexion bdd
        $nouveauVisiteur = new Visiteur();

        $roleUtilisateur = array(0=>'');
        $roleComptable =array(0=>'ROLE_COMPTABLE');
        $roleAdmin = array(0=>'ROLE_ADMIN');
        $roles = array(
            'user'=>$roleUtilisateur ,
            'comp'=>$roleComptable ,
            'user'=> $roleAdmin
        );
        $form = $this->createForm(new VisiteurType(), $nouveauVisiteur,array('roles' => $roles, 'operation'=>'changerMdp'));
        $form->handleRequest($request);

        if ($form->isValid()) {

            dump($nouveauVisiteur);die();
        }



        return $this->render('GestionFraisBundle:Default:vueTest.html.twig', array(
            'form' =>$form->createView()
        ));
    }
}