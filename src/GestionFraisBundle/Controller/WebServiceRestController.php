<?php

namespace GestionFraisBundle\Controller;

use FOS\RestBundle\Controller\Annotations\View;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use GestionFraisBundle\Entity\Visiteur;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class WebServiceRestController extends Controller
{

   public function estUnUtilisateur($requette){


       //Transfomation de la requette Json en Objet
       $requette = json_decode($requette);

       //On verifie si la requette contient bien un champ mot de passe et un champ username
       if(!isset($requette->username) || !isset($requette->password))
       {
           http_response_code(400);
           echo "Requette incorecte";
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
       return true;
   }

    /**
     * Fonction qui retourne un visiteur sous forme de JSon
     *
     * @param $requette : requette JSon contenant l'username et le mot de passe du visiteur
     *
     * @return unVisiteur : Objet JSon representant le visiteur
     */
    public function getConnexionAction($requette)
    {
        if ($this->estUnUtilisateur($requette)) {
            $requette = json_decode($requette);
            $unVisiteur = $this->getDoctrine()->getRepository('GestionFraisBundle:Visiteur')->findOneByUsername($requette->username);
            return $unVisiteur;
        }
    }

    /**
     * Fonction qui retourne une fiche frais sous forme de JSon
     *
     * @param $requette : requette JSon contenant l'username, le mot de passe du visiteur et l'id de la fiche
     *
     * @return uneFicheFrais : Objet JSon representant la fiche frais
     */
    public function getficheFraisAction($requette)
    {

        if( $this->estUnUtilisateur($requette)){

            $requette = json_decode($requette);

            //On verifie si la requette contient bien un champ mot de passe et un champ username
            if(!isset($requette->idfichefrais))
            {
                http_response_code(400);
                echo "Requette incorecte";
                exit;
            }

            $uneFicheFrais = $this->getDoctrine()->getRepository('GestionFraisBundle:FicheFrais')->findOneById($requette->idfichefrais);
            return $uneFicheFrais;

        }

    }

    public function getLesFicheFraisAction($requette){

        if($this->estUnUtilisateur($requette)){
            //Transfomation de la requette Json en Objet
            $requette = json_decode($requette);

            $unVisiteur = $this->getDoctrine()->getRepository('GestionFraisBundle:Visiteur')->findOneByUsername($requette->username);

            //Récupération des fiches du visiteur
            $lesFicheFrais = $this->getDoctrine()->getRepository('GestionFraisBundle:FicheFrais')->findByidvisiteur($unVisiteur);
            return $lesFicheFrais;
        }
    }
}