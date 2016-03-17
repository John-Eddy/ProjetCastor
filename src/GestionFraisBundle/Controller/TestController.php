<?php
/**
 * Created by PhpStorm.
 * User: Utilisateur
 * Date: 17/03/2016
 * Time: 20:15
 */


namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class TestController extends Controller
{
    public function testAction()
    {
        dump($idEtatFicheFraisDefaut = $this->container);
        dump($this->container->getParameter('idEtatLigneFraisDefaut'));
        die();
        return 0;
    }
}