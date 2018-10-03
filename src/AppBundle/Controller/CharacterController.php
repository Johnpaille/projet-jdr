<?php
/**
 * Created by PhpStorm.
 * User: cyrilkoehler
 * Date: 03/10/18
 * Time: 13:28
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;

class CharacterController
{
    /**
     * @Route("/perso")
     */
    public function showAction(){
        return new Response("bienvenue sur la page des persos");
    }
}