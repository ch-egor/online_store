<?php

namespace App\Controller\Api;

use App\Service\SecurityService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SecurityController extends AbstractController
{
    /**
     * @Route("/api/login", name="app_json_login", methods={"POST"})
     */
    public function jsonLogin(): Response
    {
        $user = $this->getUser();

        return $this->json([
            'username' => $user->getUsername(),
            'roles' => $user->getRoles(),
        ]);
    }

    /**
     * @Route("/api/user_info", name="app_user_info", methods={"POST"})
     */
    public function userInfo(): Response
    {
        return $this->json($this->getUser());
    }

    /**
     * @Route("/api/sign_up", name="app_sign_up", methods={"POST"})
     */
    public function signUp(Request $request, SecurityService $securityService): Response
    {
        $email = $request->request->get('email');
        $password = $request->request->get('password');

        return $this->json(['success' => $securityService->signUp($email, $password)]);
    }
}