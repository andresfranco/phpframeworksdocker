<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Curricullum;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Curricullum controller.
 *
 * @Route("curricullum")
 */
class CurricullumController extends Controller
{
    /**
     * Lists all curricullum entities.
     *
     * @Route("/", name="curricullum_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $curricullums = $em->getRepository('AppBundle:Curricullum')->findAll();

        return $this->render('curricullum/index.html.twig', array(
            'curricullums' => $curricullums,
        ));
    }

    /**
     * Creates a new curricullum entity.
     *
     * @Route("/new", name="curricullum_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $curricullum = new Curricullum();
        $form = $this->createForm('AppBundle\Form\CurricullumType', $curricullum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($curricullum);
            $em->flush();

            return $this->redirectToRoute('curricullum_show', array('id' => $curricullum->getId()));
        }

        return $this->render('curricullum/new.html.twig', array(
            'curricullum' => $curricullum,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a curricullum entity.
     *
     * @Route("/{id}", name="curricullum_show")
     * @Method("GET")
     */
    public function showAction(Curricullum $curricullum)
    {
        $deleteForm = $this->createDeleteForm($curricullum);

        return $this->render('curricullum/show.html.twig', array(
            'curricullum' => $curricullum,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing curricullum entity.
     *
     * @Route("/{id}/edit", name="curricullum_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Curricullum $curricullum)
    {
        $deleteForm = $this->createDeleteForm($curricullum);
        $editForm = $this->createForm('AppBundle\Form\CurricullumType', $curricullum);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('curricullum_edit', array('id' => $curricullum->getId()));
        }

        return $this->render('curricullum/edit.html.twig', array(
            'curricullum' => $curricullum,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a curricullum entity.
     *
     * @Route("/{id}", name="curricullum_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Curricullum $curricullum)
    {
        $form = $this->createDeleteForm($curricullum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($curricullum);
            $em->flush();
        }

        return $this->redirectToRoute('curricullum_index');
    }

    /**
     * Creates a form to delete a curricullum entity.
     *
     * @param Curricullum $curricullum The curricullum entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Curricullum $curricullum)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('curricullum_delete', array('id' => $curricullum->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
