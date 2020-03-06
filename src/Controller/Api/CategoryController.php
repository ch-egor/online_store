<?php

namespace App\Controller\Api;

use App\Service\CategoryService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/category")
 */
class CategoryController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function getCategories(Request $request, CategoryService $categoryService): Response
    {
        $categories = $categoryService->get();
        return $this->json($categories);
    }
}