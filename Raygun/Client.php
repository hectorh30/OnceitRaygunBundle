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

    public function setUserFromTokenStorage(TokenStorage $tokenStorage)
    {
        $user = $tokenStorage->getToken() ? $tokenStorage->getToken()->getUser() : false;

        if (!$user || !($user instanceof UserInterface)) {
            return;
        }

        return parent::SetUser(
            $user->getUsernameCanonical(),
            $user->getUsernameCanonical(),
            $user->getUsernameCanonical(),
            $user->getEmail(),
            false
        );
    }

    public function setUserFromRequestStack(
        \Lexik\Bundle\JWTAuthenticationBundle\Encoder\JWTEncoderInterface $encoder,
        \Symfony\Component\HttpFoundation\RequestStack $requestStack
    ) {
        $request = $requestStack->getCurrentRequest();

        $token = explode(' ', $request->headers->get('Authorization'));

        // If there is no user it means the request was not authenticated
        if (!array_filter($token)) {
            return;
        }

        $jwt = $encoder->decode($token[1]);

        if (!$jwt) {
            throw new \LogicException('Invalid token');
        }

        return parent::SetUser($jwt['username']);
    }
}
