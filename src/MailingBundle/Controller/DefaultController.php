<?php

namespace MailingBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('MailingBundle:Default:index.html.twig');
    }
}
