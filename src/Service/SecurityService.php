<?php

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecurityService
{
    public const ROLE_USER = 'ROLE_USER';
    public const ROLE_ADMIN = 'ROLE_ADMIN';

    public const LABELS_ROLE = [
        self::ROLE_USER => 'User',
        self::ROLE_ADMIN => 'Administrator'
    ];

    protected $em;
    protected $userRepo;
    protected $passwordEncoder;

    public function __construct(
        EntityManagerInterface $em,
        UserRepository $userRepo,
        UserPasswordEncoderInterface $passwordEncoder
    ) {
        $this->em = $em;
        $this->userRepo = $userRepo;
        $this->passwordEncoder = $passwordEncoder;
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
            ->setPassword($this->passwordEncoder->encodePassword($user, $password))
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