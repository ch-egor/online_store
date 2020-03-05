<?php

namespace App\Controller\Api;

use App\Repository\CategoryRepository;
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
    public function getCategories(Request $request, CategoryRepository $categoryRepo): Response
    {
        $categories = $categoryRepo->findAll();

        return $this->json($categories);
    }
}