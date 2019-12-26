<?php

namespace App\Controller;

use App\Model\User\UseCase\SignUp;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Zend\EventManager\Exception\DomainException;

class SecurityController extends AbstractController
{
    private $serializer;
    private $validator;

    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator)
    {
        $this->serializer = $serializer;
        $this->validator = $validator;
    }

    /**
     * @Route("/signup", name="app_login")
     */
    public function signup(Request $request, SignUp\Request\Handler $handler): Response
    {
        /** @var SignUp\Request\Command $command */
        $command = $this->serializer->deserialize(
            $request->getContent(),
            SignUp\Request\Command::class,
            'json'
        );

        $violations = $this->validator->validate($command);
        if (count($violations)) {
            $json = $this->serializer->serialize($violations, 'json');
            return new JsonResponse($json, 400, [], true);
        }

        try {
            $handler->handle($command);
        } catch (DomainException $e) {

        }
    }


}
