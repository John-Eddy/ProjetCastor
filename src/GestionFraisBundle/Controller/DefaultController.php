<?php

namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $roles = $this->getUser()->getRoles();

        echo(serialize($roles));

        if(in_array('ROLE_ADMIN',$roles))
        {
            return $this->redirectToRoute('comptable_index');
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
}
