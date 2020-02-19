<?php

namespace CampBundle\Controller;

use CampBundle\Entity\blog;
use CampBundle\Form\blogType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Response;

class BlogController extends Controller
{
    public function ajoutBlogAction(Request $request)
    {
        $blog =new blog();
        $form=$this->createForm(blogType::class,$blog);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            /**
             * @var UploadedFile $file
             */

            $file=$blog->getImage();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move($this->getParameter('image_directory'),$fileName);
            $blog->setImage($fileName);
            $em=$this->getDoctrine()->getManager();
            $em->persist($blog);
            $em->flush();
         //   return $this->redirect($this->generateUrl('camp_affiche_blog'));
        }


        return $this->render('@Camp/blog/addBlog.html.twig', array ('form' => $form->createView()));

    }

    public function afficheBlogAction($id) {
        $em = $this->getDoctrine()->getManager();
        $blog=$em->getRepository('CampBundle:blog')->findBy( array('refuge' => $id));

        return $this->render('@Camp/blog/afficheBlog.html.twig', array('blog' => $blog));
    }
}
