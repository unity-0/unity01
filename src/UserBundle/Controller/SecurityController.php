<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class SecurityController extends Controller
{

    public function redirectAction(Request $request)
    {
        if($this->isGranted('ROLE_USER')) {
            $user = $this->getUser();
            $uname=$user->getUsername();
            $em = $this->getDoctrine()->getManager();
        if($migrant = $em->getRepository("CampBundle:migrant")->findBy( array('nom' => $uname)))
            return $this->render('@Temp/Default/page_une.html.twig');

        else{
            $migrant = $em->getRepository("UserBundle:User")->findBy( array('id' => $user));
            return $this->render('@Camp/afficheMigrant_front.html.twig', array('migrant' => $migrant));
         }
        }
        else
        {
            return $this->render('@Temp/Default/page_une.html.twig');
        }
    }

}
