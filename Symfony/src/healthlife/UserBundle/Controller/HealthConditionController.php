<?php

namespace healthlife\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use healthlife\UserBundle\Entity\HealthCondition;
use healthlife\UserBundle\Form\HealthConditionType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
/**
 * HealthCondition controller.
 *
 * @Route("/healthcondition")
 */
class HealthConditionController extends Controller
{

    /**
     * Lists all HealthCondition entities.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/", name="healthcondition")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('healthlifeUserBundle:HealthCondition')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new HealthCondition entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/", name="healthcondition_create")
     * @Method("POST")
     * @Template("healthlifeUserBundle:HealthCondition:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new HealthCondition();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('healthcondition_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a HealthCondition entity.
     *
     * @param HealthCondition $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(HealthCondition $entity)
    {
        $form = $this->createForm(new HealthConditionType(), $entity, array(
            'action' => $this->generateUrl('healthcondition_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new HealthCondition entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/new", name="healthcondition_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new HealthCondition();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a HealthCondition entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/{id}", name="healthcondition_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('healthlifeUserBundle:HealthCondition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HealthCondition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing HealthCondition entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/{id}/edit", name="healthcondition_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('healthlifeUserBundle:HealthCondition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HealthCondition entity.');
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
    * Creates a form to edit a HealthCondition entity.
    *
    * @Security("has_role('ROLE_ADMIN')")
    * @param HealthCondition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(HealthCondition $entity)
    {
        $form = $this->createForm(new HealthConditionType(), $entity, array(
            'action' => $this->generateUrl('healthcondition_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing HealthCondition entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/{id}", name="healthcondition_update")
     * @Method("PUT")
     * @Template("healthlifeUserBundle:HealthCondition:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('healthlifeUserBundle:HealthCondition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find HealthCondition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('healthcondition_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a HealthCondition entity.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @Route("/{id}", name="healthcondition_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('healthlifeUserBundle:HealthCondition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find HealthCondition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('healthcondition'));
    }

    /**
     * Creates a form to delete a HealthCondition entity by id.
     *
     * @Security("has_role('ROLE_ADMIN')")
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('healthcondition_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
