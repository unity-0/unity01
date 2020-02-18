<?php

namespace EvenementBundle\Controller;

use EvenementBundle\Entity\Don;
use EvenementBundle\Form\DonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DonController extends Controller
{

    public function addAction(Request $request)
    {
        $don=new Don();
        $form=$this->createForm(DonType::class,$don);
        $form=$form->handleRequest($request);
        $don->setEvenement(null);

        if($form->isValid())// test if our form is valid
        {
            $em=$this->getDoctrine()->getManager(); // Déclaration Entity Manager
            //$ag->setLatitude($nom);
            $em->persist($don); // Persister l'objet modele dans l'ORM
            $em->flush(); // Sauvegarde des données dans la BD




        }
        return $this->render('@Evenement/Default/index.html.twig',array('form'=>$form->createView()

        ));
    }
    public function afficherAction( $nom)
    {
        $patient=$this->getDoctrine()->getRepository(Don::class)->findAll(); // Déclaration Entity Manager

        return $this->render('@Evenement/Default/index.html.twig',array('nom'=>$nom));
    }

}
