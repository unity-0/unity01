<?php

namespace EvenementBundle\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use EvenementBundle\Entity\Don;
use EvenementBundle\Form\DonType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DonController extends Controller
{

    public function addAction(Request $request)
    {
        $don = new Don();
        $form = $this->createForm(DonType::class, $don);
        $form = $form->handleRequest($request);
        $don->setEvenement(null);

        if ($form->isValid())// test if our form is valid
        {
            $em = $this->getDoctrine()->getManager(); // Déclaration Entity Manager
            //$ag->setLatitude($nom);
            $em->persist($don); // Persister l'objet modele dans l'ORM
            $em->flush(); // Sauvegarde des données dans la BD


        }
        return $this->render('@Evenement/Don/add.html.twig', array('form' => $form->createView()

        ));
    }

    public function afficherAction()
    {
        $don = $this->getDoctrine()->getRepository(Don::class)->findAll(); // Déclaration Entity Manager

        return $this->render('@Evenement/Don/afficher.html.twig', array('Don' => $don));
    }


    public function DeleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $don = $this->getDoctrine()->getRepository(Don::class)->find($id);

        $em->remove($don);
        $em->flush();

        return $this->redirect($this->generateUrl('afficher'));
    }


    public function rechercheByNomAction(Request $request)
    {


        $em = $this->getDoctrine()->getManager();
        $don = $em->getRepository("EvenementBundle:don")->findAll();
        if ($request->isMethod("POST")) {
            $nom = $request->get('nref');
            $refuge = $em->getRepository("EvenementBundle:don")->findBy(array('nom' => $nom));
        }
        return $this->render('@Camp/refuge/rechercheRefuge.html.twig', array('refuge' => $refuge));


    }

    /**
     * @Route ("map")
     */
    public function mapAction()
    {
        return $this->redirectToRoute('map');
    }

    public function pddfAction()
    {
        $don = $this->getDoctrine()->getRepository(Don::class)->findAll(); // Déclaration Entity Manager


            $pdfOptions = new Options();

            $pdfOptions->set('defaultFront', 'Arial');
            $em = $this->getDoctrine()->getManager();
            $don = $em->getRepository("EvenementBundle:Don")->findAll();

            $dompdf = new Dompdf ($pdfOptions);
            $html = $this->renderView('@Evenement/Don/Afficher.html.twig', array('Don' => $don)
            );
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();
            $dompdf->stream("mypdf.pdf", ["Attachment" => false]);



        return $this->render('@Evenement/Don/afficher.html.twig', array('Don' => $don));
    }
}






