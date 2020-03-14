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

    public function getByIdOrSlug($id)
    {
        if (is_numeric($id)) {
            return $this->categoryRepo->find($id);
        }

        return $this->categoryRepo->findOneBy(['slug' => $id]);
    }
}