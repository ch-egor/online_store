<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }

    public function load(ObjectManager $manager)
    {
        $admin = new User();
        $admin
            ->setEmail('admin@example.com')
            ->setPassword($this->passwordEncoder->encodePassword($admin, 'admin'))
            ->setRoles(['ROLE_ADMIN', 'ROLE_USER']);
        $manager->persist($admin);

        $user1 = new User();
        $user1
            ->setEmail('user1@example.com')
            ->setPassword($this->passwordEncoder->encodePassword($user1, 'user1'))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user1);

        $user2 = new User();
        $user2
            ->setEmail('user2@example.com')
            ->setPassword($this->passwordEncoder->encodePassword($user2, 'user2'))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user2);

        $user3 = new User();
        $user3
            ->setEmail('user3@example.com')
            ->setPassword($this->passwordEncoder->encodePassword($user3, 'user3'))
            ->setRoles(['ROLE_USER']);
        $manager->persist($user3);

        $manager->flush();
    }
}
