<?php

namespace tests\MasterPeace\Bundle\UserBundle\Controller;


use MasterPeace\Bundle\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Cookie;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;

class UserBundleControllerTest extends WebTestCase
{

    private $client = null;

    public function setUp()
    {
        $this->client = static::createClient();
    }

    public function testLogIn()
    {
        $this->logIn();
        // TODO: pakeisti /list i /, kai toks bus
        $crawler = $this->client->request('GET', '/list');

        $this->assertTrue($this->client->getResponse()->isSuccessful());
        // TODO: atitinkamai ir contains
        $this->assertGreaterThan(0, $crawler->filter('html:contains("user")')->count());
    }

    private function logIn()
    {
        $session = $this->client->getContainer()->get('session');

        $firewall = 'secure_area';

        $token = new UsernamePasswordToken('KarolisM', 'password', $firewall, ['ROLE_ADMIN']);
        $session->set('_security_' . $firewall, serialize($token));
        $session->save();

        $cookie = new Cookie($session->getName(), $session->getId());
        $this->client->getCookieJar()->set($cookie);
    }
    //TODO: finish test
    public function testUserRole()
    {
        $user = new User();
        $username = 'KarolisM';
        $this->assertTrue($user->isAdmin($username));
    }
}
