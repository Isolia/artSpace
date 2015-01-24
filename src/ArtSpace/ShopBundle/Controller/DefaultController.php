<?php

namespace ArtSpace\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArtSpaceShopBundle:Shop:index.html.twig' );
    }
    
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
}
