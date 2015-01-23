<?php

namespace ArtSpace\ShopBundle\Controller;

use ArtSpace\ShopBundle\Entity\Product;
use ArtSpace\ShopBundle\Entity\User;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CreateDataController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        $user = new User;
        $user->setName('Roger');
        $user->setSurname('Seguin');
        $user->setAddress('3 rue du Pipicaca');
        $user->setEmail('darksasuke666@caramail.com');
        $user->setBirthdate(new DateTime('1978/12/22'));
        $em->persist($user);

        $product = new Product;
        $product->setName('Standard');
        $product->setPrice(8);
        $product->setDescription('<ul>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">20 Pages, Galleries & Blogs</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil illum sit error, sed doloremque earum delectus quis est sint maiores.">500 GB Bandwidth</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque cupiditate placeat, sapiente quibusdam recusandae iste.">2 GB Storage</li>
                            <li class="caseFree tooltip" title="Lorem ipsum dolor sit amet.">Custom Domain<span class="free">FREE</span></li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore ut ipsam voluptates, nesciunt debitis quam, dolorum nobis, id recusandae harum temporibus ab pariatur sit at?">24/7 Support</li>
                        </ul>');
        $em->persist($product);
        
                $product = new Product;
        $product->setName('Unlimited');
        $product->setPrice(16);
        $product->setDescription('                        <ul class="listeUnlimited">
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, quibusdam.">Unlimited Pages, Galleries & Blogs</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, unde!">Unlimited Bandwidth</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, ipsa, itaque. Corrupti quidem non laudantium, itaque praesentium sapiente soluta assumenda sequi dolorum, sint natus animi!">Unlimited Storage</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">Unlimited Contributors</li>
                        </ul>
                        <ul>
                            <li class="caseFree tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, dolorum.">Custom Domain<span class="free">FREE</span></li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo voluptatum dolores natus exercitationem error eos quae nihil beatae aliquam omnis, dolorum, itaque earum, laudantium. Officiis!">Advanced From Builder</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae expedita error optio, iusto. Et, repellendus!">Google Apps & Mailchimp Sync</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">Publish to FAcebook Pages</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, hic.">24/7 Support</li>
                        </ul>');
        $em->persist($product);
        
                $product = new Product;
        $product->setName('Business');
        $product->setPrice(24);
        $product->setDescription('                        <ul class="listeUnlimited">
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, quibusdam.">Unlimited Pages, Galleries & Blogs</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, unde!">Unlimited Bandwidth</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, ipsa, itaque. Corrupti quidem non laudantium, itaque praesentium sapiente soluta assumenda sequi dolorum, sint natus animi!">Unlimited Storage</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">Unlimited Contributors</li>
                        </ul>
                        <ul>
                            <li class="caseFree tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum, dolorum.">Custom Domain<span class="free">FREE</span></li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Quo voluptatum dolores natus exercitationem error eos quae nihil beatae aliquam omnis, dolorum, itaque earum, laudantium. Officiis!">Advanced From Builder</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae expedita error optio, iusto. Et, repellendus!">Google Apps & Mailchimp Sync</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">Publish to FAcebook Pages</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eos, hic.">24/7 Support</li>
                        </ul>');
        $em->persist($product);
        
        $em->flush();
        
        return new Response('Id du produit créé : '.$user->getId());
        
        
        
    }
}
