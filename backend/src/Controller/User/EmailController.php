<?php

declare(strict_types=1);

namespace App\Controller\User;

use App\Model\User\UseCase\Email;
use DomainException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class EmailController extends AbstractController
{
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @Route("/profile/email", name="profile.email")
     * @param Request $request
     * @param Email\Request\Handler $handler
     * @return Response
     */
    public function request(Request $request, Email\Request\Handler $handler): Response
    {
        /** @var Email\Request\Command $command */
        $command = $this->serializer->deserialize(
            $request->getContent(),
            Email\Request\Command::class,
            'json',
            [
                'object_to_populate' => new Email\Request\Command($this->getUser()->getId()),
                'ignored_attributes' => ['id'],
            ]
        );

        $violations = $this->validator->validate($command);

        if (count($violations)) {
            $json = $this->serializer->serialize($violations, 'json');
            return new JsonResponse($json, 400, [], true);
        }

        $handler->handle($command);

        return $this->json([]);
    }

    /**
     * @Route("/profile/email/{token}", name="profile.email.confirm")
     * @param string $token
     * @param Email\Confirm\Handler $handler
     * @return Response
     */
    public function confirm(string $token, Email\Confirm\Handler $handler): Response
    {
        $command = new Email\Confirm\Command($this->getUser()->getId(), $token);

        try {
            $handler->handle($command);
            return $this->json([]);
        } catch (DomainException $e) {
            $json = $this->serializer->serialize([
                'success' => false,
                'message' => $e->getMessage()
            ], 'json');
            return new JsonResponse($json, 400, [], true);
        }
    }
}
