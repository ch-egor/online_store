<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Order;
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

    public function addItem(User $user, Article $article, int $quantity = 1): bool
    {

    }

    public function removeItem(User $user, Article $article): bool
    {

    }
}