<?php

namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //recuperation des données du visiteur connécté
        //$visiteur = $this->get('security.context')->getToken()->getUser();

        //recuperation des roles de ce visiteur
        $roles = array( 1 => "ROLE_UTILISATEUR");

        //controle du role du visiteur
        if(in_array('ROLE_UTILISATEUR',$roles))
        {
            return $this->redirectToRoute("utilisateur_index");
        }
        else if (in_array('ROLE_COMPTABLE',$roles))
        {
            return $this->redirectToRoute('comptable_index');
        }
        else if(in_array('ROLE_ADMIN',$roles))
        {
        }
    }
}
