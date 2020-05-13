<?php

namespace CampBundle\Controller;
use UserBundle\Entity\User;
use CampBundle\Entity\migrant;
use CampBundle\Form\migrantType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;


class MigrantController extends Controller
{
    public function ajoutMigrantAction(Request $request)
    {
        $user = $this->getUser();
        $migrant = new migrant();
        $migrant->setNom($user->getUsername());
        $migrant->setEmail($user->getEmail());
        $form = $this->createForm(migrantType::class, $migrant);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            /**
             * @var UploadedFile $file
             */

            $file = $migrant->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $migrant->setImage($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($migrant);
            $em->flush();
            return $this->redirect($this->generateUrl('camp_profil_migrant'));
        }


        return $this->render('@Camp/addMigrant.html.twig', array('form' => $form->createView()));

    }


    public function profilMigrantAction()
    {
        $user = $this->getUser();
        $uname=$user->getUsername();
        $em = $this->getDoctrine()->getManager();

        $migrant = $em->getRepository("CampBundle:migrant")->findBy( array('nom' => $uname));
        $refuge=$em->getRepository("CampBundle:migrant")->findOneBy(array('nom'=>$uname));
        $x=$refuge->getRefuge();
        $emm = $this->getDoctrine();
        $w = $emm->getRepository('CampBundle:migrant');
        $ghh = $w->counntDQL($x);
        $gh = implode("", $ghh[0]);
        $y=(float)$gh;
        $re=$em->getRepository("CampBundle:refuge")->find($x);
        $ref=$em->getRepository("CampBundle:refuge")->findBy(array('id' => $x));
        $tot=$re->getNbtot();
            $e=(int)$tot;
            $z=$y*100/$e;
            $re->setPour($z);
        $em->flush();

        return $this->render('@Camp/profileMigrant_front.html.twig', array('migrant' => $migrant,'ref'=>$ref));
    }
    /*  public function afficheProfilAction()
        {
            $user = $this->getUser();
            $em = $this->getDoctrine()->getManager();

            $migrant = $em->getRepository("UserBundle:User")->findBy( array('id' => $user));
            return $this->render('@Camp/afficheMigrant_front.html.twig', array('migrant' => $migrant));
        }
    */

    public function updateMigrantAction(Request $request, $id)
    {
        $m = $this->getDoctrine()->getManager();
        $migrant = $m->getRepository("CampBundle:migrant")->find($id);
        $form = $this->createForm(migrantType::class, $migrant);
        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            /**
             * @var UploadedFile $file
             */

            $file = $migrant->getImage();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            $file->move($this->getParameter('image_directory'), $fileName);
            $migrant->setImage($fileName);
            $m->persist($migrant);
            $m->flush();
            return $this->redirect($this->generateUrl('camp_profil_migrant'));
        }


        return $this->render('@Camp/updateMigrant.html.twig', array('form' => $form->createView()));
    }

    public function afficheMigrantAction()
    {
        $em = $this->getDoctrine()->getManager();
        $migrant = $em->getRepository('CampBundle:migrant')->findAll();

        return $this->render('@Camp/afficheMigrant.html.twig', array('migrant' => $migrant));
    }

    public function supprimerMigrantAction($id)
    {   $l= $this->getDoctrine()->getManager();
        $m = $this->getDoctrine()->getManager();
        $mod = $this->getDoctrine()
            ->getRepository('CampBundle:migrant')
            ->find($id);
        $x=$mod->getNom();
        $dom=$this->getDoctrine()->getRepository('UserBundle:User')->findOneBy( array('username' => $x));
       // $z=$dom->getId();
        $image = $mod->getImage();
        $path = $this->getParameter('image_directory') . '.' . $image;
        $fs = new Filesystem();
        $fs->remove(array($path));
        $m->remove($mod);
        $l->remove($dom);
        $m->flush();

        return $this->redirect($this->generateUrl('affichemigrant'));
    }

    public function calculAction($id)
    {
        $emm = $this->getDoctrine();
        $w = $emm->getRepository('CampBundle:migrant');
        $ghh = $w->counntDQL($id);
        $y = implode("", $ghh[0]);


    }
}

