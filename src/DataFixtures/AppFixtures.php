<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $this->loadCategories($manager);
        $this->loadArticles($manager);
    }

    private function loadCategories(ObjectManager $manager)
    {
        $fruits = new Category();
        $fruits
            ->setTitle('Fruits')
            ->setSlug('fruits');
        $manager->persist($fruits);

        $vegetables = new Category();
        $vegetables
            ->setTitle('Vegetables')
            ->setSlug('vegetables');
        $manager->persist($vegetables);

        $other = new Category();
        $other
            ->setTitle('Other')
            ->setSlug('other');
        $manager->persist($other);

        $manager->flush();
    }

    private function loadArticles(ObjectManager $manager)
    {
        $categoryRepo = $manager->getRepository(Category::class);

        $apple = new Article();
        $apple
            ->setTitle('Apple')
            ->setSlug('apple')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Fruits']))
            ->setDescription("Apple's description")
            ->setInStock(true);
        $manager->persist($apple);

        $orange = new Article();
        $orange
            ->setTitle('Orange')
            ->setSlug('orange')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Fruits']))
            ->setDescription("Orange's description")
            ->setInStock(true);
        $manager->persist($orange);

        $banana = new Article();
        $banana
            ->setTitle('Banana')
            ->setSlug('banana')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Fruits']))
            ->setDescription("Banana's description")
            ->setInStock(false);
        $manager->persist($banana);

        $carrot = new Article();
        $carrot
            ->setTitle('Carrot')
            ->setSlug('carrot')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Vegetables']))
            ->setDescription("Carrot's description")
            ->setInStock(false);
        $manager->persist($carrot);

        $tomato = new Article();
        $tomato
            ->setTitle('Tomato')
            ->setSlug('tomato')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Vegetables']))
            ->setDescription("Tomato's description")
            ->setInStock(true);
        $manager->persist($tomato);

        $manager->flush();
    }
}
