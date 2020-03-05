<?php

namespace App\Controller\Api;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function getArticles(Request $request, ArticleRepository $articleRepo): Response
    {
        $articles = $articleRepo->findAll();

        return $this->json($articles);
    }
}