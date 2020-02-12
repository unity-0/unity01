<?php

namespace mytemplat\TempBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render("@Temp/Default/index.html.twig");
    }

    public function pageAction()
    {
        return $this->render("@Temp/Default/page_une.html.twig");
    }

    public function dashAction()
    {
        return $this->render("@Temp/Default/dash_une.html.twig");
    }
}
