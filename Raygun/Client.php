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

        return call_user_func_array('parent::__construct', func_get_args());
    }
}
