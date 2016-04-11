<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 05/04/2016
 * Time: 14:28
 */

namespace GestionFraisBundle\Controller;



use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AdministrateurController extends Controller{

    public function IndexAction(){
        return $this->render('GestionFraisBundle:Utilisateur/FicheFrais:modifier.html.twig', array(
            'role'=>'administrateur',
        ));
    }
    public function visiteurAction(Request $request,$operation , $idVisiteur){

        //Connection BDD
        $em = $this->getDoctrine()->getManager();

        if($operation != 'consulter' && $operation != 'ajouter' && $operation != 'suprimer' && $operation != 'modifier') {
            throw $this->createNotFoundException();
        }

    }


}