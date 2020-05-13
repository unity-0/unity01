<?php

namespace AnnonceBundle\Controller;

use AnnonceBundle\Entity\Annonce;
use AnnonceBundle\Entity\Commentaire;
use AnnonceBundle\Form\AnnonceType;
use AnnonceBundle\Form\CommentaireType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Dompdf\Dompdf;
use Dompdf\Options;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@Annonce/Default/index.html.twig');
    }
    public function addAction(Request $request)
    {
        //instance de la classe Club $club
        $Annonce= new Annonce();
        //créer une instance de la classe Form à partir de la classe Club en utilisant
        // comme données de départ l’instance de la classe Club $club
        $form= $this->createForm(AnnonceType::class,$Annonce);
        //L’instruction $form->handleRequest($request); permet de gérer le traitement de la
        // saisie du formulaire. En effet sans autre précision, lorsque l’utilisateur valide
        // la saisie du formulaire, une requête HTTP avec la commande POST
        // est transmise avec la même url que celle qui à provoquer l’affichage
        // du formulaire . Le contenu de la requête est traitée
        // et les données affectées aux propriétés de l’instance qui a été donnée en
        // paramètre de l’instruction précédente.
        $form->handleRequest($request);
        if($form->isSubmitted()){
            //Sert à manipuler les entités
            $em = $this->getDoctrine()->getManager();
            //Garder cette entité en mémoire
            $em->persist($Annonce);
            //Enregistrer cette entité
            $em->flush();
            return $this->redirectToRoute("listAnnonce");
        }
        return $this->render("@Annonce/Default/add.html.twig",array('form'=>$form->createView()));
    }
    public function addcomAction(Request $request)
    {
        //instance de la classe Club $club
        $Annonce= new Commentaire();
        //créer une instance de la classe Form à partir de la classe Club en utilisant
        // comme données de départ l’instance de la classe Club $club
        $form= $this->createForm(CommentaireType::class,$Annonce);
        //L’instruction $form->handleRequest($request); permet de gérer le traitement de la
        // saisie du formulaire. En effet sans autre précision, lorsque l’utilisateur valide
        // la saisie du formulaire, une requête HTTP avec la commande POST
        // est transmise avec la même url que celle qui à provoquer l’affichage
        // du formulaire . Le contenu de la requête est traitée
        // et les données affectées aux propriétés de l’instance qui a été donnée en
        // paramètre de l’instruction précédente.
        $form->handleRequest($request);
        if($form->isSubmitted()){
            //Sert à manipuler les entités
            $em = $this->getDoctrine()->getManager();
            //Garder cette entité en mémoire
            $em->persist($Annonce);
            //Enregistrer cette entité
            $em->flush();
            return $this->redirectToRoute("listcom");
        }
        return $this->render("@Annonce/Default/addcom.html.twig",array('form'=>$form->createView()));
    }
    public function comAAction(Request $request)
    {
        //instance de la classe Club $club
        $Annonce= new Commentaire();
        //créer une instance de la classe Form à partir de la classe Club en utilisant
        // comme données de départ l’instance de la classe Club $club
        $form= $this->createForm(CommentaireType::class,$Annonce);
        //L’instruction $form->handleRequest($request); permet de gérer le traitement de la
        // saisie du formulaire. En effet sans autre précision, lorsque l’utilisateur valide
        // la saisie du formulaire, une requête HTTP avec la commande POST
        // est transmise avec la même url que celle qui à provoquer l’affichage
        // du formulaire . Le contenu de la requête est traitée
        // et les données affectées aux propriétés de l’instance qui a été donnée en
        // paramètre de l’instruction précédente.
        $form->handleRequest($request);
        if($form->isSubmitted()){
            //Sert à manipuler les entités
            $em = $this->getDoctrine()->getManager();
            //Garder cette entité en mémoire
            $em->persist($Annonce);
            //Enregistrer cette entité
            $em->flush();
            return $this->redirectToRoute("listcom");
        }
        return $this->render("@Annonce/Default/comA.html.twig",array('form'=>$form->createView()));
    }
    public function listcomAction(){

        $em = $this->getDoctrine()->getManager();
        $Annonce= $em->getRepository("AnnonceBundle:Commentaire")->findAll();
        return $this->render("@Annonce/Default/listcom.html.twig",array('annonce'=>$Annonce));
    }
    public function listAnnonceAction()
    {
        $em = $this->getDoctrine()->getManager();
        $Annonce= $em->getRepository("AnnonceBundle:Annonce")->findAll();
        return $this->render("@Annonce/Default/list.html.twig",array('annonce'=>$Annonce));
    }
    public function suppAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $annonce= $em->getRepository("AnnonceBundle:Annonce")->find($id);
        $em->remove($annonce);
        $em->flush();
        return $this->redirectToRoute("listAnnonce");
    }
    public function suppcomAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $annonce= $em->getRepository("AnnonceBundle:Commentaire")->find($id);
        $em->remove($annonce);
        $em->flush();
        return $this->redirectToRoute("listcom");
    }
    public function updateAnnonceAction($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        //Sert à récupérer les entités
        $annonce= $em->getRepository("AnnonceBundle:Annonce")->find($id);
        $form= $this->createForm(AnnonceType::class,$annonce);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->flush();
            return $this->redirectToRoute("listAnnonce");
        }
        return $this->render("@Annonce/Default/update.html.twig",array('form'=>$form->createView()));


    }

    public function updateComAction($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        //Sert à récupérer les entités
        $annonce= $em->getRepository("AnnonceBundle:Commentaire")->find($id);
        $form= $this->createForm(CommentaireType::class,$annonce);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->flush();
            return $this->redirectToRoute("listcom");
        }
        return $this->render("@Annonce/Default/updateCom.html.twig",array('form'=>$form->createView()));


    }



    public  function afficherAction()
    {  $liste=$this->getDoctrine()->getRepository(Annonce::class)->findAll();
        return $this->render("@Annonce/Default/afficherA.html.twig",array("liste"=>$liste));


    }


    public  function afficherComAction()
    {  $liste=$this->getDoctrine()->getRepository(Annonce::class)->findAll();
        return $this->render("@Annonce/Default/afficherCom.html.twig",array("liste"=>$liste));


    }
    public  function pdfAction (  )
    {

        $pdfOptions = new Options();

        $pdfOptions->set('defaultFront','Arial');
        $em = $this->getDoctrine()->getManager();
        $annonce= $em->getRepository("AnnonceBundle:Annonce")->findAll();

        $dompdf=new Dompdf ($pdfOptions);
        $html =$this->renderView('@Annonce/Default/listp.html.twig',array('annonce'=>$annonce)
        );
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4','portrait');
        $dompdf->render();
        $dompdf->stream("mypdf.pdf",["Attachment" => false ]);

    }

}
