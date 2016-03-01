<?php

namespace GestionFraisBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use GestionFraisBundle\Entity\LigneFraisHorsForfait;
use GestionFraisBundle\Form\LigneFraisHorsForfaitType;

/**
 * LigneFraisHorsForfaitUtilisateur controller.
 *
 */
class LigneFraisHorsForfaitUtilisateurController extends Controller
{
    /**
     * Lists all LigneFraisHorsForfait entities.
     *    */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->findAll();

        return $this->render('GestionFraisBundle:LigneFraisHorsForfait:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new LigneFraisHorsForfait entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new LigneFraisHorsForfait();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('lignefraishorsforfait_show', array('id' => $entity->getId())));
        }

        return $this->render('GestionFraisBundle:LigneFraisHorsForfait:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a LigneFraisHorsForfait entity.
     *
     * @param LigneFraisHorsForfait $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(LigneFraisHorsForfait $entity)
    {
        $form = $this->createForm(new LigneFraisHorsForfaitType(), $entity, array(
            'action' => $this->generateUrl('lignefraishorsforfait_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new LigneFraisHorsForfait entity.
     *
     */
    public function newAction($id)
    {
        $entity = new LigneFraisHorsForfait();
        $entity->setIdfichefrais($id);
        $form   = $this->createCreateForm($entity);

        return $this->render('GestionFraisBundle:LigneFraisHorsForfait:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a LigneFraisHorsForfait entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LigneFraisHorsForfait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionFraisBundle:LigneFraisHorsForfait:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing LigneFraisHorsForfait entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LigneFraisHorsForfait entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('GestionFraisBundle:LigneFraisHorsForfait:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a LigneFraisHorsForfait entity.
    *
    * @param LigneFraisHorsForfait $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(LigneFraisHorsForfait $entity)
    {
        $form = $this->createForm(new LigneFraisHorsForfaitType(), $entity, array(
            'action' => $this->generateUrl('lignefraishorsforfait_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing LigneFraisHorsForfait entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find LigneFraisHorsForfait entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('lignefraishorsforfait_edit', array('id' => $id)));
        }

        return $this->render('GestionFraisBundle:LigneFraisHorsForfait:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a LigneFraisHorsForfait entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('GestionFraisBundle:LigneFraisHorsForfait')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find LigneFraisHorsForfait entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('lignefraishorsforfait'));
    }

    /**
     * Creates a form to delete a LigneFraisHorsForfait entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('lignefraishorsforfait_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}
?>