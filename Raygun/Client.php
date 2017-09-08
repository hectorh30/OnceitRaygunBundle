<?php

namespace Onceit\RaygunBundle\Raygun;

use Raygun4php\RaygunClient;
use FOS\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class Client extends RaygunClient
{
    /**
     * {@inheritDoc}
     */
    public function Send($message)
    {
        if (empty($this->apiKey)) {
            return;
        }

        return parent::Send($message);
    }
}
