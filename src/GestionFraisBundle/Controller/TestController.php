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
    public function testAction($requette)
    {
        dump(json_decode($requette));die();
    }
}