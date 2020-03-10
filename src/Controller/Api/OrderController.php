<?php

namespace App\Controller\Api;

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
        $order = $orderService->getCurrentOrder($this->getUser());

        return $this->json($order);
    }

    public function addItem(Request $request, OrderService $orderService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        return $this->json([]);
    }

    public function removeItem(Request $request, OrderService $orderService): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_REMEMBERED');

        return $this->json([]);
    }
}