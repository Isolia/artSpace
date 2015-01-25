<?php

namespace ArtSpace\ShopBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ArtSpaceShopBundle:Shop:index.html.twig');
    }
}
