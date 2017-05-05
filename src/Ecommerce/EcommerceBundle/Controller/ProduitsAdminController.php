<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Produit controller.
 *
 */
class ProduitsAdminController extends Controller
{
    /**
     * Lists all produit entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();


        $produits = $em->getRepository('EcommerceBundle:Produits')->findAll();
        $role =0;
        if(in_array('ROLE_ADMIN',$this->getUser()->getroles()))
        {
            $role = 1 ;
        }

        if(in_array('ROLE_SIMPLE',$this->getUser()->getroles()))
        {
            $role = 2 ;
        }
   
        return $this->render('EcommerceBundle:Administration:produits/layout/index.html.twig', array(
            'produits' => $produits,'role'=>$role));
    }

    /**
     * Creates a new produit entity.
     *
     */
    public function newAction(Request $request)
    {
        $produit = new Produits();
        $form = $this->createForm('Ecommerce\EcommerceBundle\Form\ProduitsType', $produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($produit);
            $em->flush();

            return $this->redirectToRoute('adminProduits_show', array('id' => $produit->getId()));
        }

        return $this->render('EcommerceBundle:Administration:produits/layout/new.html.twig', array(
            'produit' => $produit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a produit entity.
     *
     */
    public function showAction(Produits $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $role =0;
        if(in_array('ROLE_ADMIN',$this->getUser()->getroles()))
        {
            $role = 1 ;
        }
        
        if(in_array('ROLE_SIMPLE',$this->getUser()->getroles()))
        {
            $role = 2 ;
        }
        return $this->render('EcommerceBundle:Administration:produits/layout/show.html.twig', array(
            'produit' => $produit,
            'role' =>$role,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing produit entity.
     *
     */
    public function editAction(Request $request, Produits $produit)
    {
        $deleteForm = $this->createDeleteForm($produit);
        $editForm = $this->createForm('Ecommerce\EcommerceBundle\Form\ProduitsType', $produit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('adminProduits_edit', array('id' => $produit->getId()));
        }
        $role=0;
        if(in_array('ROLE_ADMIN',$this->getUser()->getroles()))
        {
            $role = 1 ;
        }
        
        if(in_array('ROLE_SIMPLE',$this->getUser()->getroles()))
        {
            $role = 2 ;
        }
        return $this->render('EcommerceBundle:Administration:produits/layout/edit.html.twig', array(
            'produit' => $produit,
            'role' => $role,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a produit entity.
     *
     */
    public function deleteAction(Request $request, Produits $produit)
    {
        $form = $this->createDeleteForm($produit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($produit);
            $em->flush();
        }

        return $this->redirectToRoute('adminProduits_index');
    }

    /**
     * Creates a form to delete a produit entity.
     *
     * @param Produits $produit The produit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Produits $produit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('adminProduits_delete', array('id' => $produit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
