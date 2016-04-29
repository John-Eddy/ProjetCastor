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


    /**
     * Fonction qui retourne un visiteur sous forme de JSon
     *
     * @param $requette : requette JSon contenant l'username et le mot de passe du visiteur
     *
     * @return unVisiteur : Objet JSon representant le visiteur
     */
    public function getConnexionAction($requette){

        //Transfomation de la requette Json en Objet
        $requette = json_decode($requette);

        //On verifie si la requette contient bien un champ mot de passe et un champ username
        if(!isset($requette->username) || !isset($requette->password))
        {
            http_response_code(400);
            echo "Champs manquant";
            exit;
        }

        $unVisiteur = $this->getDoctrine()->getRepository('GestionFraisBundle:Visiteur')->findOneByUsername($requette->username);

        if (!$unVisiteur)
        {
            http_response_code(400);
            echo "Validation Failed";
            exit;
        }
        //Service qui s'occupe de l'encodage du mot de passe
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($unVisiteur);

        //On verifie si le mot de passe corespon au mot de passe du visiteur
        $validated = $encoder->isPasswordValid($unVisiteur->getPassword(), $requette->password, $unVisiteur->getSalt());

        if (!$validated) {
            http_response_code(400);
            echo "Validation Failed";
            exit;
        }
        else {
            return $unVisiteur;
        }
    }
    public function getLesFicheFraisAction($requette){

        //Transfomation de la requette Json en Objet
        $requette = json_decode($requette);

        //On verifie si la requette contient bien un champ mot de passe et un champ username
        if(!isset($requette->username) || !isset($requette->password) )
        {
            http_response_code(400);
            echo "Champs manquant";
            exit;
        }

        $unVisiteur = $this->getDoctrine()->getRepository('GestionFraisBundle:Visiteur')->findOneByUsername($requette->username);

        if (!$unVisiteur)
        {
            http_response_code(400);
            echo "Validation Failed";
            exit;
        }
        //Service qui s'occupe de l'encodage du mot de passe
        $factory = $this->container->get('security.encoder_factory');
        $encoder = $factory->getEncoder($unVisiteur);

        //On verifie si le mot de passe corespon au mot de passe du visiteur
        $validated = $encoder->isPasswordValid($unVisiteur->getPassword(), $requette->password, $unVisiteur->getSalt());

        if (!$validated) {
            http_response_code(400);
            echo "Validation Failed";
            exit;
        }
        else {
            //Récupération des fiches du visiteur
            $lesFicheFrais = $this->getDoctrine()->getRepository('GestionFraisBundle:FicheFrais')->findByidvisiteur($unVisiteur);
            return $lesFicheFrais;
        }
    }
}