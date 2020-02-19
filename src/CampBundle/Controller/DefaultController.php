<?php

namespace CampBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('CampBundle:Default:index.html.twig');
    }
}
