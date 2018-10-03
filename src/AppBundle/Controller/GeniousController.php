<?php
/**
 * Created by PhpStorm.
 * User: cyrilkoehler
 * Date: 03/10/18
 * Time: 13:22
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Templating;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;
use Symfony\Component\Templating\Loader\FilesystemLoader;

class GeniousController extends Controller {
    /**
     * @Route("/genus/{genusName}")
     */
    public function showAction($genusName){
        $templating = $this->container->get('templating');
        $html = $templating->render('genus/show.html.twig', [
            'name' => $genusName
        ]);
        return new Response($html);
    }
}