<?php
namespace ArtSpace\ShopBundle\Controller;

use ArtSpace\ShopBundle\Entity\User;
use ArtSpace\ShopBundle\Form\UserRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

use ArtSpace\ShopBundle\Entity\CartItem;
use ArtSpace\ShopBundle\Entity\PastOrder;

class UserController extends Controller
{
    public function loginAction(Request $request){
        $session = $request->getSession();

        // get the login error if there is one
        if ($request->attributes->has(Security::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(
                Security::AUTHENTICATION_ERROR
            );
        } elseif (null !== $session && $session->has(Security::AUTHENTICATION_ERROR)) {
            $error = $session->get(Security::AUTHENTICATION_ERROR);
            $session->remove(Security::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get(Security::LAST_USERNAME);

        return $this->render(
            'ArtSpaceShopBundle:User:login.html.twig',
            array(
                // last username entered by the user
                'last_username' => $lastUsername,
                'error'         => $error,
            )
         );
    }
    
    // Création de la vue du formulaire
    public function registerAction(Request $request)
    {    
        //on créer un utilisateur vide
        $user = new User();
        
        //on récupére une instance de notre formulaire
        //ce form est associé à l'utilisateur vide
        $registrationForm = $this->createForm(new UserRegistrationType(), $user);

        //traite le formulaire
        $registrationForm->handleRequest($request);
        
        //si les données sont valides...
        if ($registrationForm->isValid() ){
            //hydrate les autres propriétés de notre User
            //générer un salt
            $salt = md5(uniqid());
            $user->setSalt($salt);
            
            ////hacher le mot de passe
            $encoder = $this->container->get('security.password_encoder');
            $encoded = $encoder->encodePassword($user, $user->getPassword() );
            $user->setPassword($encoded);
            
            //sauvegarde le User en bdd
            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();
            
            
            return $this->redirect($this->generateUrl('art_space_shop_index'));
        }
        else
        {
            //on envoie le formulaire à twig 
            return $this->render('ArtSpaceShopBundle:User:register.html.twig', array('registrationForm'=>$registrationForm->createView()) );
        }
    }
    
    public function addToCartAction($productId)
    {   
        $em = $this->getDoctrine()->getManager();        
        // On récupère l'objet (l'instance) du user connecté
        $user = $this->getUser();
        
        // On récupère l'instance du produit à ajouter
        $product = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Product')
            ->findOneById($productId);
        
        // On ajoute le produit au caddie
        $existingCartItem = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:CartItem')
            ->findOneBy(array('user' => $user, 'product' => $product));
        
        // Verifie si le produit existe dans le caddie sinon creation de l'item dans le caddie 
        if($existingCartItem){
            $existingCartItem->setQuantity( 1 + $existingCartItem->getQuantity() );
            $em->persist($existingCartItem);
        }
        else
        {
            $cartItem = new CartItem;
            $cartItem->setProduct($product);
            $cartItem->setUser($user);
            $cartItem->setQuantity(1);
               
            $em->persist($cartItem);
        }
        $em->flush();
        return $this->redirect($this->generateUrl('art_space_shop_cart'));
    }
    
    public function viewCartAction()
    {
        $user = $this->getUser();
        
        // Récupére tout les items du caddie de l'utilisateur
        $cartitems = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:CartItem')
            ->findByUser($user);
        
        // Calcul le total du caddie
        $total = 0;
        foreach($cartitems as $cartitem){
            $total = $total + ( $cartitem->getProduct()->getPrice() * $cartitem->getQuantity() );
        }

        return $this->render('ArtSpaceShopBundle:User:cart.html.twig', array('cartitems'=>$cartitems, 'total'=>$total));
    }
    
        public function submitCartAction()
    {
        // Selectionne tout le chariot
        $user = $this->getUser();
        $cart = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:CartItem')
            ->findByUser($user);
        
        // Transfere le caddie dans les commandes passées (PastOrder)
        $em = $this->getDoctrine()->getManager();  
        foreach($cart as $cartItem){
            $pastOrder = new PastOrder;
            $pastOrder->setProduct($cartItem->getProduct());
            $pastOrder->setUser($cartItem->getUser());
            $pastOrder->setQuantity($cartItem->getQuantity());
            $pastOrder->setDate(new \DateTime);
            
            $em->persist($pastOrder);
            $em->remove($cartItem);
        }
        $em->flush();
        
        return $this->redirect($this->generateUrl('art_space_shop_cart'));
    }
    
    public function increaseQuantityAction($cartItemId){
        $user = $this->getUser();
        $cartItem = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:CartItem')
            ->findOneById($cartItemId);
        
        // securité
        if ($user!=$cartItem->getUser()){
            return $this->redirect($this->generateUrl('art_space_shop_index'));
        }
        
        $cartItem->setQuantity(1+$cartItem->getQuantity());
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($cartItem);
        $em->flush();
        
        return $this->redirect($this->generateUrl('art_space_shop_cart'));
    }
    
    public function decreaseQuantityAction($cartItemId){
        $user = $this->getUser();
        $cartItem = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:CartItem')
            ->findOneById($cartItemId);
        
        // securité
        if ($user!=$cartItem->getUser()){
            return $this->redirect($this->generateUrl('art_space_shop_index'));
        }
        
        $cartItem->setQuantity($cartItem->getQuantity()-1);
        
        $em = $this->getDoctrine()->getManager();
        if($cartItem->getQuantity()>0){
            $em->persist($cartItem);
        }
        else{
            $em->remove($cartItem);
        }
        $em->flush();
        
        return $this->redirect($this->generateUrl('art_space_shop_cart'));
    }
    
    public function pastOrderAction()
    {
}