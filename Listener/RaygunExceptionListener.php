<?php

namespace Onceit\RaygunBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Raygun4php\RaygunClient;

class RaygunExceptionListener
{

    protected $client;

    /**
     * @param \Raygun4php\RaygunClient
     */
    public function __construct(RaygunClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if ($exception instanceof HttpException) {
            return;
        }

        $this->client->SendException($exception);

    }
}
