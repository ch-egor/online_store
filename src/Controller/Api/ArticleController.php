<?php

namespace App\Controller\Api;

use App\Service\ArticleService;
use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/article")
 */
class ArticleController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function getArticles(Request $request, CategoryService $categoryService, ArticleService $articleService): Response
    {
        $category = null;
        $categoryId = $request->query->get('category');

        if ($categoryId !== null) {
            $category = $categoryService->getByIdOrSlug($categoryId);
            if (!$category) {
                throw new BadRequestHttpException('Category not found.');
            }
        }

        $articles = $articleService->get($category);

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