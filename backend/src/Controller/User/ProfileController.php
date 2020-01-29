<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityNotFoundException;
use Ramsey\Uuid\Uuid;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @param UserRepository $userRepository
     * @return JsonResponse
     *
     * @Route("/user-info", name="user_info", methods={"GET"})
     */
    public function userInfo(UserRepository $userRepository): JsonResponse
    {
        try {
            $user = $userRepository->get(Uuid::fromString($this->getUser()->getId()));
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
