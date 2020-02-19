<?php

namespace CampBundle\Controller;

use CampBundle\Entity\refuge;
use CampBundle\Form\refugeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;



class RefugeController extends Controller
{
    public function ajoutRefugeAction(Request $request)
    {
        $refuge =new refuge();
        $form=$this->createForm(refugeType::class,$refuge);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */

            $file=$refuge->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName);
            $refuge->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($refuge);
            $em->flush();
          return $this->redirect($this->generateUrl('camp_affiche_refuge'));
        }


        return $this->render('@Camp/refuge/addRefuge.html.twig', array ('form' => $form->createView()));

    }
    public function afficheRefugeAction() {
        $em = $this->getDoctrine()->getManager();
            $refuge=$em->getRepository('CampBundle:refuge')->findAll();

        return $this->render('@Camp/refuge/afficheRefuge.html.twig', array('refuge' => $refuge));
    }
    public function afficheRefugeFrontAction() {
        $em = $this->getDoctrine()->getManager();
        $refuge=$em->getRepository('CampBundle:refuge')->findAll();

        return $this->render('@Camp/refuge/afficheRefuge_front.html.twig', array('refuge' => $refuge));
    }

    public function updateRefugeAction(Request $request, $id)
    {
        $m=$this->getDoctrine()->getManager();
        $refuge=$m->getRepository("CampBundle:refuge")->find($id);
        $form=$this->createForm(refugeType::class,$refuge);
        $form->handleRequest($request);
        if($form->isSubmitted()) {
            /**
             * @var UploadedFile $file
             */

            $file=$refuge->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName);
            $refuge->setImage($fileName);
            $m->persist($refuge);
            $m->flush();
            return $this->redirect($this->generateUrl('camp_affiche_refuge'));
        }


        return $this->render('@Camp/refuge/updateRefuge.html.twig', array('form' => $form->createView()));
    }

    public function supprimerRefugeAction($id) {
        $m=$this->getDoctrine()->getManager();
        $mod = $this->getDoctrine()
            ->getRepository('CampBundle:refuge')
            ->find($id);
        $image=$mod->getImage();
        $path=$this->getParameter('image_directory').'.'.$image;
        $fs=new Filesystem();
        $fs->remove(array($path));
        $m->remove($mod);
        $m->flush();

        return $this->redirect($this->generateUrl('camp_affiche_refuge'));
    }
}
