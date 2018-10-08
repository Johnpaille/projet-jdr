<?php
/**
 * Created by PhpStorm.
 * User: cyrilkoehler
 * Date: 03/10/18
 * Time: 13:28
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

class CharacterController extends Controller
{
    /**
     * @Route("perso")
     */
    public function showAction(){
        $aPersos = CharacterController::getCharacters();
        $templating = $this->container->get('templating');
        $html = $templating->render('show.html.twig', [
            'name' => "persos",
            'type' => "character",
            'persos' => $aPersos
        ]);
        return new Response($html);
    }

    // Récupération de tous les personnages
    public function getCharacters(){
        $em = $this->getDoctrine()->getManager();
        $qry = "SELECT * FROM personnage";
        $statement = $em->getConnection()->prepare($qry);
        $statement->bindValue("status", 1);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    // Affiche les détails d'un personnage
    /**
     * @Route("perso/{id}")
     */
    public function showCharacter($id) {
        $perso = CharacterController::getCharacter($id);
        $templating = $this->container->get('templating');
        if(isset($_POST["validForm"]) && $_POST["validForm"] == 1){
            
        }
        $html = $templating->render('show.html.twig', [
            'name' => "perso",
            'type' => "showCharacter",
            'perso' => $perso[0]
        ]);
        return new Response($html);
    }

    // Affiche la page de modification d'un personnage
    /**
     * @Route("perso/{id}/edit")
     */
    public function showEditCharacter($id) {
        $perso = CharacterController::getCharacter($id);
        $templating = $this->container->get('templating');
        $html = $templating->render('show.html.twig', [
            'name' => "perso",
            'type' => "editCharacter",
            'perso' => $perso[0]
        ]);
        return new Response($html);
    }


    // Récupération d'un personnage
    public function getCharacter($id){
        $em = $this->getDoctrine()->getManager();
        $qry = "SELECT * FROM personnage WHERE id = ".$id;
        $statement = $em->getConnection()->prepare($qry);
        $statement->bindValue("status", 1);
        $statement->execute();
        $res = $statement->fetchAll();
        return $res;
    }

    // Ajout d'un nouveau personnage

    /**
     * @Route("perso/new")
     */
    public function newCharacter(){
        $templating = $this->container->get('templating');
        $html = $templating->render('show.html.twig', [
            'name' => "persos",
            'type' => "newCharacter",
        ]);

        if(isset($_GET["nom"]) && $_GET["nom"] != ""){
            $this->insertCharacter($_GET);
        } elseif(isset($_GET["nom"]) && $_GET["nom"] == "") {
            echo "Erreur lors de l'ajout d'un nouveau personnage";
        }

        return new Response($html);
    }

    // Insert du nouveau personnage
    public function insertCharacter($aPerso){
        $em = $this->getDoctrine()->getManager();
        $qry = "INSERT INTO personnage VALUES ('',
          '" . $_GET["nom"] . "',
          '" . $_GET["prenom"] . "',
          " . $_GET["cc"] . ",
          " . $_GET["ct"] . ",
          " . $_GET["f"] . ",
          " . $_GET["e"] . ",
          " . $_GET["ag"] . ",
          " . $_GET["int"] . ",
          " . $_GET["fm"] . ",
          " . $_GET["soc"] . ",
          " . $_GET["a"] . ",
          " . $_GET["b"] . ",
          " . $_GET["bf"] . ",
          " . $_GET["be"] . ",
          " . $_GET["m"] . ",
          " . $_GET["mag"] . ",
          " . $_GET["pf"] . ",
          " . $_GET["pd"] . "
        )";
        $statement = $em->getConnection()->prepare($qry);
        $statement->bindValue("status", 1);
        $statement->execute();
    }
    
    // Update du personnage
    
}