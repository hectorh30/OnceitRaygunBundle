<?php

namespace Onceit\RaygunBundle\Listener;

use Symfony\Component\Console\Event\ConsoleExceptionEvent,
    Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent,
    Symfony\Component\HttpKernel\Exception\HttpException;

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

    /**
     * @param \Symfony\Component\Console\Event\ConsoleExceptionEvent $event
     */
    public function onConsoleException(ConsoleExceptionEvent $event)
    {
        $this->client->SendException($exception);   
    }
    
}
