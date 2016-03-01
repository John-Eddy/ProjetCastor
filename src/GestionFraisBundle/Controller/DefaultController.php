<?php

namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->redirectToRoute("utilisateur_index");
        /*recuperation des roles du visiteur connécté
        /$roles = $this->get('security.context')->getToken()->getUser()->getRoles();

        echo(serialize($roles));
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
            return $this->redirectToRoute('comptable_index');
        }*/
    }
}
