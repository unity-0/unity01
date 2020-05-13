<?php

namespace CampBundle\Controller;
use CampBundle\Entity\refuge;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
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
            return $this->redirect($this->generateUrl('camp_affiche_refuge_front'));
        }


        return $this->render('@Camp/blog/addBlog.html.twig', array ('form' => $form->createView()));

    }

    public function afficheBlogAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog=$em->getRepository('CampBundle:blog')->findBy( array('refuge' => $id));

        return $this->render('@Camp/blog/afficheBlog.html.twig', array('blog' => $blog));
    }

    public function statAction()
    {
        $pieChart = new PieChart();
        $gh=0;
        $ghh=0;
        $em= $this->getDoctrine();
        $blogs = $em->getRepository('CampBundle:blog')->findAll();
        $w = $em->getRepository('CampBundle:blog');
        $data= array();
        $stat=['Blog', 'nbPost'];
        $nb=0;
        array_push($data,$stat);
        $x = 0;
        $nbtot = (int)$x;

        foreach($blogs as $blog)
        { $nbtot++ ; }

        $m = $this->getDoctrine()->getManager();
        $refs = $m->getRepository("CampBundle:refuge")->findAll();

        foreach($refs as $ref) {
            $br = $ref->getNom();
            $ar = $ref->getId();


            $ghh = $w->counntDQL($ar);
            $x = implode("", $ghh[0]);

           // $y ='blog';
            $stat= array();
            array_push($stat, $br, (($x * 100) / $nbtot));
            $nb = (($x * 100) / $nbtot);
            $stat = [$br, $nb];
            array_push($data, $stat);
        }



        //array_push($data,$stat);
        $pieChart->getData()->setArrayToDataTable(
            $data
        );
        $pieChart->getOptions()->setTitle('Pourcentages des post par blog de refuge ');
        $pieChart->getOptions()->setHeight(500);
        $pieChart->getOptions()->setWidth(900);
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor('#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);
        return $this->render('@Camp/blog/chart.html.twig', array('piechart' => $pieChart));
    }


}
