<?php

namespace App\Service;

use App\Entity\Article;
use App\Repository\ArticleRepository;

class ArticleService
{
    protected $articleRepo;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function get($categoryId = null)
    {
        if ($categoryId !== null) {
            return $this->articleRepo
                ->createQueryBuilder('a')
                ->leftJoin('a.category', 'c')
                ->where('c.id = :categoryId')
                ->setParameter('categoryId', $categoryId)
                ->getQuery()
                ->getResult();
        }

        return $this->articleRepo->findAll();
    }

    public function getById($id): ?Article
    {
        return $this->articleRepo->find($id);
    }
}