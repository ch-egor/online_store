<?php

namespace App\Controller\Api;

use App\Service\ArticleService;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/api/order")
 */
class OrderController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function getCurrentOrder(Request $request, OrderService $orderService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $user = $this->getUser();
        $order = $orderService->getCurrentOrder($user);

        return $this->json($order);
    }

    /**
     * @Route("/items/{articleId}", methods={"POST"})
     */
    public function updateItem($articleId, Request $request, ArticleService $articleService, OrderService $orderService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $user = $this->getUser();
        $article = $articleService->getById($articleId);
        $quantity = $request->request->getInt('quantity', 1);

        if (!$article->getInStock()) {
            throw $this->createAccessDeniedException('Item is out of stock.');
        }

        return $this->json([
            'success' => $orderService->updateItem($user, $article, $quantity),
        ]);
    }

    /**
     * @Route("/items/{articleId}", methods={"DELETE"})
     */
    public function removeItem($articleId, Request $request, ArticleService $articleService, OrderService $orderService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        $user = $this->getUser();
        $article = $articleService->getById($articleId);

        return $this->json([
            'success' => $orderService->removeItem($user, $article),
        ]);
    }
}