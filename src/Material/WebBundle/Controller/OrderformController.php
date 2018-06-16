<?php

namespace Material\WebBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Material\WebBundle\Entity\Orderform;
use Material\WebBundle\Form\OrderformType;

/**
 * Orderform controller.
 *
 * @Route("/orderform")
 */
class OrderformController extends BaseController
{

    /**
     * Lists all Orderform entities.
     *
     * @Route("/", name="orderform")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $entities = $this->getOrderformRepository()->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Orderform entity.
     *
     * @Route("/", name="orderform_create")
     * @Method("POST")
     * @Template("MaterialWebBundle:Orderform:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Orderform();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $materialId = $form->get('material')->getData()->getId();
        $orign_num = $form->get('material')->getData()->getNumber();
        $add_num = $form->get('need_num')->getData();
        $tmp = $orign_num + $add_num ;
        $materialEntity = $this->getMaterialRepository()->find($materialId);
        $materialEntity->setNumber($tmp);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('orderform_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Orderform entity.
     *
     * @param Orderform $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Orderform $entity)
    {
        $form = $this->createForm(new OrderformType(), $entity, array(
            'action' => $this->generateUrl('orderform_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Orderform entity.
     *
     * @Route("/new", name="orderform_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Orderform();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Orderform entity.
     *
     * @Route("/{id}", name="orderform_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $entity = $this->getOrderformRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orderform entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Orderform entity.
     *
     * @Route("/{id}/edit", name="orderform_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $entity = $this->getOrderformRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orderform entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Orderform entity.
    *
    * @param Orderform $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Orderform $entity)
    {
        $form = $this->createForm(new OrderformType(), $entity, array(
            'action' => $this->generateUrl('orderform_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Orderform entity.
     *
     * @Route("/{id}", name="orderform_update")
     * @Method("PUT")
     * @Template("MaterialWebBundle:Orderform:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $this->getOrderformRepository()->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Orderform entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('orderform_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Orderform entity.
     *
     * @Route("/{id}", name="orderform_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('MaterialWebBundle:Orderform')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Orderform entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('orderform'));
    }

    /**
     * Creates a form to delete a Orderform entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orderform_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
