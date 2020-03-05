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
        $fruits->setTitle('Fruits');
        $manager->persist($fruits);

        $vegetables = new Category();
        $vegetables->setTitle('Vegetables');
        $manager->persist($vegetables);

        $other = new Category();
        $other->setTitle('Other');
        $manager->persist($other);

        $manager->flush();
    }

    private function loadArticles(ObjectManager $manager)
    {
        $categoryRepo = $manager->getRepository(Category::class);

        $apple = new Article();
        $apple
            ->setTitle('Apple')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Fruits']))
            ->setDescription("Apple's description")
            ->setInStock(true);
        $manager->persist($apple);

        $orange = new Article();
        $orange
            ->setTitle('Orange')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Fruits']))
            ->setDescription("Orange's description")
            ->setInStock(true);
        $manager->persist($orange);

        $banana = new Article();
        $banana
            ->setTitle('Banana')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Fruits']))
            ->setDescription("Banana's description")
            ->setInStock(false);
        $manager->persist($banana);

        $carrot = new Article();
        $carrot
            ->setTitle('Carrot')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Vegetables']))
            ->setDescription("Carrot's description")
            ->setInStock(false);
        $manager->persist($carrot);

        $tomato = new Article();
        $tomato
            ->setTitle('Tomato')
            ->setCategory($categoryRepo->findOneBy(['title' => 'Vegetables']))
            ->setDescription("Tomato's description")
            ->setInStock(true);
        $manager->persist($tomato);

        $manager->flush();
    }
}
