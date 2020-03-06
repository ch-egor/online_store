<?php

namespace App\Service;

use App\Repository\CategoryRepository;

class CategoryService
{
    protected $categoryRepo;

    public function __construct(CategoryRepository $categoryRepo)
    {
        $this->categoryRepo = $categoryRepo;
    }

    public function get()
    {
        return $this->categoryRepo->findAll();
    }

    public function getById($id)
    {
        return $this->categoryRepo->find($id);
    }
}