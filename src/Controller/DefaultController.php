<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/")
     * @Route("/{route}", requirements={"route"="^(?!.*_wdt|_profiler|_error).+"})
     */
    public function index()
    {
        return $this->render('encore.html.twig');
    }
}