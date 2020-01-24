<?php

declare(strict_types=1);

namespace App\Controller;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class UsersController extends AbstractController
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @Route("/user-info", name="user_info", methods={"GET"})
     */
    public function userInfo()
    {
        try {
            $user = $this->userRepository->get(Uuid::fromString($this->getUser()->getId()));
        } catch (EntityNotFoundException $e) {
            return $this->json([
                'message' => $e->getMessage()
            ]);
        }

        return $this->json([
            'email' => $user->getEmail()->getValue(),
            'role' => $user->getRole()->getValue(),
            'status' => $user->getStatus(),
            'name' => $user->getName(),
        ]);
    }
}
