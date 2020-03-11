<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\User;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    protected $em;
    protected $orderRepo;

    public function __construct(EntityManagerInterface $em, OrderRepository $orderRepo)
    {
        $this->em = $em;
        $this->orderRepo = $orderRepo;
    }

    public function getCurrentOrder(User $user): Order
    {
        $order = $this->orderRepo
            ->createQueryBuilder('o')
            ->leftJoin('o.user', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $user->getId())
            ->andWhere('o.processed = 0')
            ->addOrderBy('o.id', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getOneOrNullResult();

        if ($order === null) {
            $order = new Order();
            $order
                ->setUser($user)
                ->setProcessed(false);

            $this->em->persist($order);
            $this->em->flush();
        }

        return $order;
    }

    public function updateItem(User $user, ?Article $article, int $quantity = 1): bool
    {
        if ($article === null) {
            return false;
        }
        if ($quantity <= 0) {
            return $this->removeItem($user, $article);
        }

        $item = $this->getItem($user, $article);
        if ($item === null) {
            $item = new OrderItem();
            $item
                ->setOrder($this->getCurrentOrder($user))
                ->setArticle($article);

            $this->em->persist($item);
        }

        $item->setQuantity($quantity);
        $this->em->flush();

        return true;
    }

    public function removeItem(User $user, ?Article $article): bool
    {
        if ($article === null) {
            return false;
        }

        $item = $this->getItem($user, $article);
        if ($item === null) {
            return false;
        }

        $this->em->remove($item);
        $this->em->flush();

        return true;
    }

    private function getItem(User $user, Article $article): ?OrderItem
    {
        $order = $this->getCurrentOrder($user);
        foreach ($order->getOrderItems() as $item) {
            if ($item->getArticle() === $article) {
                return $item;
            }
        }

        return null;
    }
}