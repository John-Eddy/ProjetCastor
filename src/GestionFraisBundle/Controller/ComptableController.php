<?php
/**
 * Created by PhpStorm.
 * User: Eddy
 * Date: 14/12/2015
 * Time: 14:09
 */

namespace GestionFraisBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ComptableController extends Controller
{
    public function indexAction(){

        return $this->render('GestionFraisBundle:Comptable:index.html.twig');
    }

}