<?php

declare(strict_types=1);

namespace App\Controller;

use DomainException;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\KernelEvents;

class DomainExceptionFormatter implements EventSubscriberInterface
{
    private $errors;

    public function __construct(ErrorHandler $errors)
    {
        $this->errors = $errors;
    }

    public static function getSubscribedEvents(): array
    {
        return array(
            KernelEvents::EXCEPTION => 'onKernelException'
        );
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getException();

        if (!$exception instanceof DomainException) {
            return;
        }

        $this->errors->handle($exception);

        $event->setResponse(new JsonResponse([
            'error' => [
                'code' => 400,
                'message' => $exception->getMessage(),
            ]
        ], 400));
    }
}
