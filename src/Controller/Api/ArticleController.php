<?php

namespace App\Controller\Api;

use App\Service\ArticleService;
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
    public function getArticles(Request $request, ArticleService $articleService): Response
    {
        $articles = $articleService->get();
        return $this->json($articles);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getArticle(Request $request, $id, ArticleService $articleService): Response
    {
        $article = $articleService->getById($id);
        return $this->json($article);
    }
}