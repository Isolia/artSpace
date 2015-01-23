<?php

namespace ArtSpace\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArtSpaceShopBundle:Shop:index.html.twig' );
    }
        
    public function pricingAction()
    {        
        $products = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Product')
            ->findAll();

        if (!$products) {
            throw $this->createNotFoundException('Aucun produit trouvé');
        }
 
         return $this->render('ArtSpaceShopBundle:Shop:pricing.html.twig', array('products' => $products) );
    }
    
}
