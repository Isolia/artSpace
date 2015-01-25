<?php
namespace ArtSpace\ShopBundle\Controller;

use ArtSpace\ShopBundle\Entity\User;
use ArtSpace\ShopBundle\Form\UserRegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

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
    
    /* Création de la vue du formulaire */
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
        // On récupère l'objet (l'instance) du user connecté
        $user = $this->getUser();
        
        // On récupère l'instance du produit à ajouter
        $product = $this->getDoctrine()
            ->getRepository('ArtSpaceShopBundle:Product')
            ->findOneById($productId);
        
        // On ajoute le produit au caddie
        $user->addCart($product);
        
        $em = $this->getDoctrine()->getManager();
        $em->persist($user);
        $em->flush();
            
        return $this->redirect($this->generateUrl('art_space_shop_cart'));
    }
    
    public function viewCartAction()
    {
        $user = $this->getUser();
        
        $products= $user->getCart();
        
        return $this->render('ArtSpaceShopBundle:User:cart.html.twig', array('products'=>$products));
    }
}