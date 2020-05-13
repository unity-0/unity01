<?php

namespace AssociationBundle\Controller;

use AssociationBundle\Entity\Association;
use Doctrine\DBAL\Schema\View;
use Doctrine\ORM\Mapping\AssociationOverride;
use http\Client\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bridge\Twig\Node\RenderBlockNode;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Association controller.
 * @Route("association")
 */
class AssociationController extends Controller
{
    /**
     * Lists all association entities.
     *
     * @Route("/", name="association_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        /** @var string $associations */
        $associations = $em->getRepository('AssociationBundle:Association')->findAll();

        return $this->render('association/index.html.twig', array(
            'associations' => $associations,
        ));
    }

    /**
     * Creates a new association entity.
     *
     * @Route("/new", name="association_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $association = new Association();
        $form = $this->createForm('AssociationBundle\Form\AssociationType', $association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($association);
            $em->flush();

            return $this->redirectToRoute('association_show', array('id' => $association->getId()));
        }

        return $this->render('association/new.html.twig', array(
            'association' => $association,
            'form' => $form->createView(),
        ));
    }

    public function newaAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $Association= new Task();
        $Association->setNomAssociation($request->get('nomAssociation'));
        $Association->setTelAssociation($request->get('telAssociation'));
        $Association->setEmailAssociation($request->get('emailAssociation'));
        $Association->setAdresseAssociation($request->get('adresseAssociation'));
        $Association->setDescriptionAssociation($request->get('descriptionAssociation'));
        $Association->setNomPresidantAssociation($request->get('nomPresidantAssociation'));
        $em->persist($Association);
        $em->flush();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Association);
        return new JsonResponse($formatted);
    }

    /**
     * Finds and displays a association entity.
     * @Route("/{id}", name="association_show")
     * @ParamConverter("association", options={"mapping": {"id"   : "id"}})
     * @Method("GET")
     */
    public function showAction(Association $association)


    {
$association=NULL;
        $deleteForm = $this->createDeleteForm($association);

        return $this->render('association/show.html.twig', array(
            'association' => $association,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing association entity.
     *@ParamConverter("association", options={"mapping": {"id"   : "id"}})
     * @Route("/{id}/edit", name="association_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Association $association)
    {
        $deleteForm = $this->createDeleteForm($association);
        $editForm = $this->createForm('AssociationBundle\Form\AssociationType', $association);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('association_edit', array('id' => $association->getId()));
        }

        return $this->render('association/edit.html.twig', array(
            'association' => $association,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    public function findAction($id)
    {
        $Association = $this->getDoctrine()->getManager()
            ->getRepository('AssociationBundle:Association')
            ->find($id);
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Association);
        return new JsonResponse($formatted);
    }

    /**
     * Deletes a association entity.
     * @Route("/{id}", name="association_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Association $association)
    {
        $form = $this->createDeleteForm($association);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($association);
            $em->flush();
        }

        return $this->redirectToRoute('association_index');
    }

    /**
     * Creates a form to delete a association entity.
     *
     * @param Association $association The association entity
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    private function createDeleteForm(Association $association)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('association_delete', array('id' => $association->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }

    public function allAction()
    {
        $Association = $this->getDoctrine()->getManager()
            ->getRepository('AssociationBundle:Association')
            ->findAll();
        $serializer = new Serializer([new ObjectNormalizer()]);
        $formatted = $serializer->normalize($Association);
        return new JsonResponse($formatted);
    }



}
