<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

class SecurityService
{
    protected $em;
    protected $userRepo;

    public function __construct(EntityManagerInterface $em, UserRepository $userRepo)
    {
        $this->em = $em;
        $this->userRepo = $userRepo;
    }

    public function signUp(?string $email, ?string $password): bool
    {
        if (!$email || !$password) {
            return false;
        }
        if ($this->isAlreadySignedUp($email)) {
            return false;
        }

        $user = new User();
        $user
            ->setEmail($email)
            ->setPassword($password)
            ->setRoles(['ROLE_USER']);

        $this->em->persist($user);
        $this->em->flush();

        return true;
    }

    public function isAlreadySignedUp(string $email): bool
    {
        $user = $this->userRepo->findOneBy(['email' => $email]);
        return $user !== null;
    }
}