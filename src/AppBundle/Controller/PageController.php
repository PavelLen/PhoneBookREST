<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends Controller
{
    /**
     * @Route("/")
     */
    public function home()
    {
        return $this->render('@App/Pages/test.htm.twig');
    }

}