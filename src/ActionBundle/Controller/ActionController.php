<?php

namespace ActionBundle\Controller;

use ActionBundle\Entity\Action;
use ActionBundle\Entity\Postcomment;
use ActionBundle\Form\ActionType as ActionTypeAlias;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\User\UserInterface;


class ActionController extends Controller
{

    public function addAction(Request $request)
    {
        $action=new Action();
        $form=$this->createForm(ActionTypeAlias::class,$action);
        $form=$form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {


            /** @var UploadedFile $photoFile */
            $photoFile = $form->get('photo')->getData();

            // this condition is needed because the 'brochure' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($photoFile) {
                $originalFilename = pathinfo($photoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = transliterator_transliterate('Any-Latin; Latin-ASCII; [^A-Za-z0-9_] remove; Lower()', $originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$photoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $photoFile->move(
                        $this->getParameter('photos_action'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
                $action->setPhoto($newFilename);
            }

            // ... persist the $product variable or any other work
            $em=$this->getDoctrine()->getManager(); // Déclaration Entity Manager
            //$ag->setLatitude($nom);

            $action->setDate(new \DateTime('now'));
            $em->persist($action); // Persister l'objet modele dans l'ORM
            $em->flush();

            return $this->redirect($this->generateUrl('list'));



        }
        return $this->render('@Action/Action/add.html.twig',array('form'=>$form->createView()

        ));


    }
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
       $actions= $em->getRepository("ActionBundle:Action")->findAll();
        return $this->render("@Action/Action/list.html.twig",array('actions'=>$actions));
    }
    public function listactionAction()
    {
        $em = $this->getDoctrine()->getManager();
        $actions= $em->getRepository("ActionBundle:Action")->findAll();
        return $this->render("@Action/Action/listaction.html.twig",array('actions'=>$actions));
    }

    public function suppAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $action= $em->getRepository("ActionBundle:Action")->find($id);
        $em->remove($action);
        $em->flush();
        return $this->redirectToRoute("list");
    }

    public function updateAction($id,Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        //Sert à récupérer les entités
        $action= $em->getRepository("ActionBundle:Action")->find($id);
        $form= $this->createForm(ActionTypeAlias::class,$action);
        $form->handleRequest($request);
        if($form->isSubmitted()){
            $em->flush();
            return $this->redirectToRoute("list");
        }
        return $this->render("@Action/Action/update.html.twig",array('form'=>$form->createView()));

    }
    public function showdetailedAction($id)
    {
        $em= $this->getDoctrine()->getManager();
        $action=$em->getRepository("ActionBundle:Action")->find($id);
        return $this->render('@Action/Action/details.html.twig', array(
            'title'=>$action->getTitre(),
            'date'=>$action->getDate(),
            'photo'=>$action->getPhoto(),
            'description'=>$action->getDescription(),
            'actions'=>$action,
            'comments'=>$action,
            'id'=>$action->getId()
        ));
    }
    public function searchAction(Request $request)
    {
        $em= $this->getDoctrine()->getManager();
        $actions=$em->getRepository(Action::class)->findAll();
        if ($request->isMethod("POST"))
        {
            $titre=$request->get("titre");
            $actions=$em->getRepository("ActionBundle:Action")->findBy(array("titre"=>$titre));
        }
        return $this->render('@Action/Action/recherche.html.twig',array('actions'=>$actions));
    }



    public function addCommentAction(Request $request, UserInterface $user)
    {
        //if ($this->container->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_ANONYMOUSLY')) {
        //   return new RedirectResponse('/login');
        //}
        //$this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY', null, 'unable to access this page.');

        $ref = $request->headers->get('referer');

        $action = $this->getDoctrine()
            ->getRepository(Action::class)
            ->findActionByid($request->request->get('action_id'));

        $comment = new Postcomment();

        $comment->setUser();
        $comment->setAction();
        $comment->setPostedAt();
        $comment->setContent($request->request->get('comment'));
        $em = $this->getDoctrine()->getManager();
        $em->persist($comment);
        $em->flush();

        $this->addFlash(
            'info', 'Comment published !.'
        );

        return $this->redirect($ref);

    }
    public function deleteCommentAction(Request $request)
    {
        $id = $request->get('id');
        $em= $this->getDoctrine()->getManager();
        $comment=$em->getRepository('ActionBundle:Postcomment')->find($id);
        $em->remove($comment);
        $em->flush();
        return $this->redirectToRoute('detailed');
    }


}

