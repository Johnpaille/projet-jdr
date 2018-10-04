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
        $templating = $this->container->get('templating');
        $html = $templating->render('show.html.twig', [
            'name' => "persos",
            'type' => "perso"
        ]);
        return new Response($html);
    }
}