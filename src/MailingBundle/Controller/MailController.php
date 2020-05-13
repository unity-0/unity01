<?php

namespace MailingBundle\Controller;

use MailingBundle\Entity\mail;
use MailingBundle\Form\mailType;
use MailingBundle\MailingBundle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class MailController extends Controller
{

    public function sendMailAction(Request $request)
    {
        $mail =new mail();
        $form=$this->createForm('MailingBundle\Form\mailType',$mail);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $sujet=$mail->getSujet();
            $email=$mail->getEmail();
            $objet=$mail->getObjet();
            $username='mohammedtest01@gmail.com';

            $message= \Swift_Message::newInstance()
            ->setSubject($sujet)
            ->setFrom($username)
            ->setTo($email)
            ->setBody($objet);
            $this->get('mailer')->send($message);
            $this->get('session')->getFlashBag()->add('notice','message envoye');

          //  return $this->redirect($this->generateUrl('camp_affiche_refuge'));
        }


        return $this->render('@Mailing/mail/addMail.html.twig', array ('form' => $form->createView()));

    }


}
