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
        $categoryId = $request->query->get('category');
        $articles = $articleService->get($categoryId);

        return $this->json($articles);
    }

    /**
     * @Route("/{id}", methods={"GET"})
     */
    public function getArticle($id, Request $request, ArticleService $articleService): Response
    {
        $article = $articleService->getById($id);
        return $this->json($article);
    }
}