<?php

namespace AssociationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function     indexAction()
    {
        return $this->render('@Association/Default/index.html.twig');
    }
}
