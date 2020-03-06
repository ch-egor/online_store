<?php

namespace App\Service;

use App\Repository\ArticleRepository;

class ArticleService
{
    protected $articleRepo;

    public function __construct(ArticleRepository $articleRepo)
    {
        $this->articleRepo = $articleRepo;
    }

    public function get()
    {
        return $this->articleRepo->findAll();
    }

    public function getById($id)
    {
        return $this->articleRepo->find($id);
    }
}