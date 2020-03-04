<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/admin")
 */
class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="admin_index", methods={"GET"})
     */
    public function index()
    {
        return $this->redirectToRoute('user_index');
    }
}