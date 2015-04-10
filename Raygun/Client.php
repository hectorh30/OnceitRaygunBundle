<?php

namespace Onceit\RaygunBundle\Raygun;

use Raygun4php\RaygunClient;

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
