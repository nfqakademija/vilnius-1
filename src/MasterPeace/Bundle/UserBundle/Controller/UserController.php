<?php

namespace MasterPeace\Bundle\UserBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * @Route("/list", name="user_list")
     * @return Response
     */
    public function listAction()
    {
        $repository = $this->getDoctrine()
            ->getRepository('MasterPeaceUserBundle:User');

        $users = $repository->findAll();

        return $this->render('@MasterPeaceUser/list.html.twig', ['users' => $users]);
    }

    /**
     * @Route("/", name="user_login")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function logInAction()
    {
        return $this->redirect($this->generateUrl('fos_user_security_login'));
    }
}
