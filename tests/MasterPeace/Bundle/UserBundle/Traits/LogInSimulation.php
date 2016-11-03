<?php

namespace Tests\MasterPeace\Bundle\UserBundle\Traits;

use Symfony\Component\BrowserKit\Client;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

trait LogInSimulation
{
    /**
     * @param Client $client
     * @param array $roles
     * @param string $username
     * @param string $password
     */
    public function logIn(Client $client, array $roles, string $username, string $password)
    {
        $session = $client->getContainer()->get('session');

        $firewall = 'secure_area';

        $token = new UsernamePasswordToken($username, $password, $firewall, $roles);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $client->getCookieJar()->set($cookie);
    }
}