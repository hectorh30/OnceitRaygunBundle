<?php

namespace Onceit\RaygunBundle\Listener;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Raygun4php\RaygunClient;

class ShutdownListener
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
     * @param Symfony\Component\HttpKernel\Event\FilterControllerEvent $event
     */
    public function register(FilterControllerEvent $event)
    {
        register_shutdown_function(array($this, 'onShutdown'));
    }

    public function onShutdown()
    {
        // Get the last error if there was one, if not, let's get out of here.
        if (!$error = error_get_last()) {
            return;
        }

        $fatal = array(E_ERROR,E_PARSE,E_CORE_ERROR,E_COMPILE_ERROR,E_USER_ERROR,E_RECOVERABLE_ERROR);
        if (!in_array($error['type'], $fatal)) {
            return;
        }

        $this->client->SendError($error['type'], $error['message'], $error['file'], $error['line']);
    }
}
