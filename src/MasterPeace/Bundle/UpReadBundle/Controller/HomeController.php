<?php

namespace MasterPeace\Bundle\UpReadBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @return Response
     */
    public function redirectAction(): Response
    {
        return $this->redirect('/login');
    }

    /**
     * @Route("/usercheck")
     *
     * @return Response
     */
    public function userCheckAction(): Response
    {
        if ($this->get('security.authorization_checker')->isGranted('ROLE_TEACHER')) {
            return $this->redirect('/teacher/classroom/list');
        } elseif ($this->get('security.authorization_checker')->isGranted('ROLE_STUDENT')) {
            return $this->redirect('/student/classroom/list');
        }
        return $this->redirectToRoute('homepage');
    }
}