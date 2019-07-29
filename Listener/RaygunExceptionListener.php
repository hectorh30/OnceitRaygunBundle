<?php

namespace Onceit\RaygunBundle\Listener;

use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Raygun4php\RaygunClient;

class RaygunExceptionListener
{
    protected $client;

    protected $tags;

    /**
     * @param \Raygun4php\RaygunClient
     */
    public function __construct(RaygunClient $client, $tags = array())
    {
        $this->client = $client;
        $this->tags = $tags;
    }

    /**
     * @param \Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        // TODO: We should allow the user to define which type of exceptions get
        // notified
        // if ($exception instanceof HttpException) {
        //     return;
        // }

        $this->client->SendException(
            $exception,
            $this->tags ? : null
        );
    }
}
