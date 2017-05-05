<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Form\RechercheType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;



class ProduitsController extends Controller
{
    public function produitsAction()
    {
     
        $session = $this->get('request')->getSession();
        $em = $this->getDoctrine()->getManager();
        
       
            $findProduits = $em->getRepository('EcommerceBundle:Produits')->findall();
                
        if ($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;
        //Commence par 1 à 3
        $produits = $this->get('knp_paginator')->paginate($findProduits,$this->get('request')->query->get('page', 1),3);
        
        
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits' => $produits,
                            'panier' => $panier));
    }
    
    public function presentationAction($id)
    {
        $session = $this->get('request')->getSession();
        $em =$this->getDoctrine()->getManager();
        $produit=  $em->getRepository('EcommerceBundle:Produits')->find($id);
        
        if(!$produit)  throw $this->createNotFoundException('La page n\'existe pas .');
        if($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier  = false ;
        
        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig',array('produit'=>$produit,
                                                                                                     'panier' => $panier));
    }
     
    public function rechercheAction()
    {
        $form = $this->createForm(new RechercheType()) ;
        return $this->render('EcommerceBundle:Default:recherche/modulesUsed/recherche.html.twig',array('form'=>$form->createView()));
    }
     
    public function rechercheTraitementAction()
    {
        $form = $this->createForm(new RechercheType()) ;
        if($this->get('request')->getMethod() == 'POST')
        {
            $form->bind($this->get('request'));
        
        $em =$this->getDoctrine()->getManager();
        $findProduits=  $em->getRepository('EcommerceBundle:Produits')->recherche($form['recherche']->getData());
        $produits = $this->get('knp_paginator')->paginate($findProduits,$this->get('request')->query->get('page', 1),3);
        
        }
        else 
        {
            throw $this->createNotFoundException('La page n\'existe pas .');
        }
        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig',array('produits'=>$produits));
    }
}
