<?php

namespace ArtSpace\ShopBundle\Controller;

use ArtSpace\ShopBundle\Entity\Product;
use ArtSpace\ShopBundle\Entity\User;
use ArtSpace\ShopBundle\Entity\Section;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CreateDataController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        
        /* Création d'un User*/
        $user = new User;
        $user->setUsername('admin');
        $user->setName('Admin');
        $user->setSurname('Admin');
        $user->setAddress('3 rue du chat noir');
        $user->setEmail('admin@artspace.com');
        $user->setBirthdate(new DateTime('1978/12/22'));
        $user->setIsAdmin(1);
        $em->persist($user);
        
        /* Création des sections */
        $section_st = new Section;
        $section_st->setName('Standard');
        $em->persist($section_st);
        
        $section_un = new Section;
        $section_un ->setName('Unlimited');
        $em->persist($section_un );
        
        $section_bu = new Section;
        $section_bu->setName('Business');
        $em->persist($section_bu);
        
        /* Création des produits */
        $product = new Product;
        $product->setSection($section_st);
        $product->setName('Standard : Basic');
        $product->setPrice(4);
        $product->setDescription('<ul>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">10 Pages, Galleries & Blogs</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil illum sit error, sed doloremque earum delectus quis est sint maiores.">250 GB Bandwidth</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque cupiditate placeat, sapiente quibusdam recusandae iste.">1 GB Storage</li>
                            <li class="caseFree tooltip" title="Lorem ipsum dolor sit amet.">Custom Domain<span class="free">FREE</span></li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore ut ipsam voluptates, nesciunt debitis quam, dolorum nobis, id recusandae harum temporibus ab pariatur sit at?">24/7 Support</li>
                        </ul>');
        $em->persist($product);
        
        $product = new Product;
        $product->setSection($section_st);
        $product->setName('Standard : Advanced');
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
        $product->setSection($section_un);
        $product->setName('Unlimited : Basic');
        $product->setPrice(14);
        $product->setDescription('<ul>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">30 Pages, Galleries & Blogs</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil illum sit error, sed doloremque earum delectus quis est sint maiores.">750 GB Bandwidth</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque cupiditate placeat, sapiente quibusdam recusandae iste.">8 GB Storage</li>
                            <li class="caseFree tooltip" title="Lorem ipsum dolor sit amet.">Custom Domain<span class="free">FREE</span></li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae expedita error optio, iusto. Et, repellendus!">Google Apps & Mailchimp Sync</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore ut ipsam voluptates, nesciunt debitis quam, dolorum nobis, id recusandae harum temporibus ab pariatur sit at?">24/7 Support</li>
                        </ul>');
        $em->persist($product);
        
        $product = new Product;
        $product->setSection($section_un);
        $product->setName('Unlimited : Advanced');
        $product->setPrice(16);
        $product->setDescription('<ul>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">40 Pages, Galleries & Blogs</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil illum sit error, sed doloremque earum delectus quis est sint maiores.">1 TO Bandwidth</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eaque cupiditate placeat, sapiente quibusdam recusandae iste.">16 GB Storage</li>
                            <li class="caseFree tooltip" title="Lorem ipsum dolor sit amet.">Custom Domain<span class="free">FREE</span></li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Vitae expedita error optio, iusto. Et, repellendus!">Google Apps & Mailchimp Sync</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Inventore ut ipsam voluptates, nesciunt debitis quam, dolorum nobis, id recusandae harum temporibus ab pariatur sit at?">24/7 Support</li>
                        </ul>');
        $em->persist($product);
        
        
        $product = new Product;
        $product->setSection($section_bu);
        $product->setName('Business : Basic');
        $product->setPrice(20);
        $product->setDescription('<ul class="listeUnlimited">
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
        $product->setSection($section_bu);
        $product->setName('Business : Advanced');
        $product->setPrice(24);
        $product->setDescription('<ul class="listeUnlimited">
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nesciunt, quibusdam.">Unlimited Pages, Galleries & Blogs</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Magnam, unde!">Unlimited Bandwidth</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cumque, ipsa, itaque. Corrupti quidem non laudantium, itaque praesentium sapiente soluta assumenda sequi dolorum, sint natus animi!">Unlimited Storage</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">Unlimited Contributors</li>
                            <li class="tooltip" title="Lorem ipsum dolor sit amet.">Dedicated support line !</li>
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
        
        return new Response('Database initialisé');
        
        
        
    }
}
