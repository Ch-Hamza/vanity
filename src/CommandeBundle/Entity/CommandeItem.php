<?php

namespace CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * CommandeItem
 *
 * @ORM\Table(name="commande_item")
 * @ORM\Entity(repositoryClass="CommandeBundle\Repository\CommandeItemRepository")
 */
class CommandeItem
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="CommandeBundle\Entity\Commande", inversedBy="items")
     */
    private $commande;

    /**
     * @ORM\ManyToOne(targetEntity="ProductBundle\Entity\Product", cascade={"persist"})
     */
    private $product;

    /**
     * @var string
     *
     * @ORM\Column(name="size", type="string")
     */
    private $size;

    /**
     * @var string
     *
     * @ORM\Column(name="color", type="string")
     */
    private $color;

    /**
     * @var string
     *
     * @ORM\Column(name="gender", type="text")
     */
    private $gender;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return CommandeItem
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    

    /**
     * Set commande
     *
     * @param \CommandeBundle\Entity\Commande $commande
     *
     * @return CommandeItem
     */
    public function setCommande(\CommandeBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \CommandeBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set product
     *
     * @param \ProductBundle\Entity\Product $product
     *
     * @return CommandeItem
     */
    public function setProduct(\ProductBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \ProductBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * @return string
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param string $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param mixed $color
     */
    public function setColor($color)
    {
        $this->color = $color;
    }

    /**
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * @param string $gender
     */
    public function setGender($gender)
    {
        $this->gender = $gender;
    }

}
