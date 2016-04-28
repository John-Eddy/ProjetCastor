<?php

namespace GestionFraisBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GestionFraisBundle\Entity\Visiteur;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class WebServiceRestController extends Controller
{
    public function getVisiteurAction($username){
        $em = $this->getDoctrine();
        $user = $em->getRepository('GestionFraisBundle:Visiteur')->findOneByUsername($username);
        if(!is_object($user)){
            throw $this->createNotFoundException();
        }
        return $user;
    }

    public function getConnetionAction($requette){

        $requette = json_decode($requette);

        if(!isset($requette->username) || !isset($requette->password)){
            $message = 'erreur format';
            return json_encode($message);
        }

        $em = $this->getDoctrine();
        $unVisiteur = $em->getRepository('GestionFraisBundle:Visiteur')->findOneByUsername($requette->username);

        dump($hashedPassword);die();

        if(!is_object($unVisiteur)){
            $message = "nom d'utilisateur incorecte";
            return json_encode($message);
        }
        else if($unVisiteur->getPassword() != hash('bdcrypt',$requette->password))
        {
            $message = 'mot de passe incorecte';
            return json_encode($message);
        }
        else{
            return $unVisiteur;
        }
    }
    public function getLesFicheFraisAction($requette){

        $requette = json_decode($requette);

        if(!isset($requette->username) || !isset($requette->password)){
            $message = 'mauvais format';
            return json_encode($message);
        }

        $em = $this->getDoctrine();
        $unVisiteur = $em->getRepository('GestionFraisBundle:Visiteur')->findOneByUsername($requette->username);

        if(!is_object($unVisiteur)){
            $message = 'nom d\'utilisateur incorecte';
            return json_encode($message);
        }
        else if($unVisiteur->getPassword() != $requette->password)
        {
            $message = 'mot de passe incorecte';
            return json_encode($message);
        }

        $lesFicheFrais = $em->getRepository('GestionFraisBundle:FicheFrais')->findByidvisiteur($unVisiteur);

        return $lesFicheFrais;

    }
}