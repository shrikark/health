<?php

namespace healthlife\UserBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use healthlife\UserBundle\Entity\Condition;
use healthlife\UserBundle\Form\ConditionType;

/**
 * Condition controller.
 *
 * @Route("/condition")
 */
class ConditionController extends Controller
{

    /**
     * Lists all Condition entities.
     *
     * @Route("/", name="condition")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('healthlifeUserBundle:Condition')->findAll();//var_dump($em);die;

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Condition entity.
     *
     * @Route("/", name="condition_create")
     * @Method("POST")
     * @Template("healthlifeUserBundle:Condition:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Condition();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('condition_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Condition entity.
     *
     * @param Condition $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Condition $entity)
    {
        $form = $this->createForm(new ConditionType(), $entity, array(
            'action' => $this->generateUrl('condition_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Condition entity.
     *
     * @Route("/new", name="condition_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Condition();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Condition entity.
     *
     * @Route("/{id}", name="condition_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('healthlifeUserBundle:Condition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Condition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Condition entity.
     *
     * @Route("/{id}/edit", name="condition_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('healthlifeUserBundle:Condition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Condition entity.');
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
    * Creates a form to edit a Condition entity.
    *
    * @param Condition $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Condition $entity)
    {
        $form = $this->createForm(new ConditionType(), $entity, array(
            'action' => $this->generateUrl('condition_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Condition entity.
     *
     * @Route("/{id}", name="condition_update")
     * @Method("PUT")
     * @Template("healthlifeUserBundle:Condition:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('healthlifeUserBundle:Condition')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Condition entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('condition_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Condition entity.
     *
     * @Route("/{id}", name="condition_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('healthlifeUserBundle:Condition')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Condition entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('condition'));
    }

    /**
     * Creates a form to delete a Condition entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('condition_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
