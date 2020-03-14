<?php

namespace App\Service;

use App\Entity\Article;
use App\Entity\Category;
use App\Repository\ArticleRepository;

class ArticleService
{
    protected $articleRepo;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function get(Category $category = null)
    {
        if ($category !== null) {
            return $this->articleRepo
                ->createQueryBuilder('a')
                ->leftJoin('a.category', 'c')
                ->where('c.id = :categoryId')
                ->setParameter('categoryId', $category->getId())
                ->getQuery()
                ->getResult();
        }

        return $this->articleRepo->findAll();
    }

    public function getByIdOrSlug($id): ?Article
    {
        if (is_numeric($id)) {
            return $this->articleRepo->find($id);
        }

        return $this->articleRepo->findOneBy(['slug' => $id]);
    }
}