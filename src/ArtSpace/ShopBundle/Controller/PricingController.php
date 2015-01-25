<?php

namespace ArtSpace\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PricingController extends Controller
{
    // Permet d'aller chercher le nom de chaque section présente dans la base de donnée
    public function pricingAction()
    {        
        $sections = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Section')
            ->findAll();

        if (!$sections) {
            throw $this->createNotFoundException('Aucune section trouvée');
        }
 
         return $this->render('ArtSpaceShopBundle:Shop:pricing.html.twig', array('sections' => $sections) );
    }
    
    public function pricingSectionAction($sectionname)
    {
        $section = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Section')
            ->findOneByName($sectionname);
        
        if (!$section) {
            throw $this->createNotFoundException('La section correspondente n\'a pas été trouvée');
        }
        
        $products= $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Product')
            ->findBySection($section);

        if (!$products) {
            throw $this->createNotFoundException('Aucun produit trouvée');
        }
 
         return $this->render('ArtSpaceShopBundle:Shop:pricingsection.html.twig', array('products' => $products, 'section'=> $section) );
    }
    
     public function pricingProductAction($sectionname, $productname)
    {
        $section = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Section')
            ->findOneByName($sectionname);
        
        if (!$section) {
            throw $this->createNotFoundException('La section correspondente n\'a pas été trouvée');
        }
        
        $product= $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Product')
            ->findOneBy(array('section' => $section, 'name' => $productname));

        if (!$product) {
            throw $this->createNotFoundException('Aucun produit trouvée');
        }
 
         return $this->render('ArtSpaceShopBundle:Shop:pricingproduct.html.twig', array('product' => $product) );
    }
}
