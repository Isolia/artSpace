<?php

namespace ArtSpace\ShopBundle\Entity;


use ArtSpace\ShopBundle\Entity\PastOrder;
use ArtSpace\ShopBundle\Entity\Product;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM; 

/**
 * User
 *
 * @ORM\Table(name="user")
 * @ORM\Entity
 */
class User
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="surname", type="string", length=255)
     */
    private $surname;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var DateTime
     *
     * @ORM\Column(name="birthdate", type="date")
     */
    private $birthdate;

    /**
     * @var ArrayCollection
     *
     * @ORM\ManyToMany(targetEntity="Product", cascade={"persist"})
     * @ORM\JoinTable(name="cart")
     */
    private $cart;
    
     /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="PastOrder", mappedBy="user", cascade={"persist"})
     */
    private $pastOrders;
    
   
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set surname
     *
     * @param string $surname
     * @return User
     */
    public function setSurname($surname)
    {
        $this->surname = $surname;

        return $this;
    }

    /**
     * Get surname
     *
     * @return string 
     */
    public function getSurname()
    {
        return $this->surname;
    }

    /**
     * Set address
     *
     * @param string $address
     * @return User
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string 
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set birthdate
     *
     * @param DateTime $birthdate
     * @return User
     */
    public function setBirthdate($birthdate)
    {
        $this->birthdate = $birthdate;

        return $this;
    }

    /**
     * Get birthdate
     *
     * @return DateTime 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }
    
    public function __construct()
    {
        $this->cart = new ArrayCollection();
        
        $this->pastOrders = new ArrayCollection();
    }

    /**
     * Add cart
     *
     * @param \ArtSpace\ShopBundle\Entity\Product $cart
     * @return User
     */
    public function addCart(\ArtSpace\ShopBundle\Entity\Product $cart)
    {
        $this->cart[] = $cart;

        return $this;
    }

    /**
     * Remove cart
     *
     * @param \ArtSpace\ShopBundle\Entity\Product $cart
     */
    public function removeCart(\ArtSpace\ShopBundle\Entity\Product $cart)
    {
        $this->cart->removeElement($cart);
    }

    /**
     * Get cart
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCart()
    {
        return $this->cart;
    }

    /**
     * Add pastOrders
     *
     * @param \ArtSpace\ShopBundle\Entity\PastOrder $pastOrders
     * @return User
     */
    public function addPastOrder(\ArtSpace\ShopBundle\Entity\PastOrder $pastOrders)
    {
        $this->pastOrders[] = $pastOrders;

        return $this;
    }

    /**
     * Remove pastOrders
     *
     * @param \ArtSpace\ShopBundle\Entity\PastOrder $pastOrders
     */
    public function removePastOrder(\ArtSpace\ShopBundle\Entity\PastOrder $pastOrders)
    {
        $this->pastOrders->removeElement($pastOrders);
    }

    /**
     * Get pastOrders
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPastOrders()
    {
        return $this->pastOrders;
    }
}
