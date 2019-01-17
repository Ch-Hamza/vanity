<?php

namespace ProductBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Color
 *
 * @ORM\Table(name="color")
 * @ORM\Entity(repositoryClass="ProductBundle\Repository\ColorRepository")
 */
class Color
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
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="red", type="integer")
     */
    private $red;

    /**
     * @var int
     *
     * @ORM\Column(name="green", type="integer")
     */
    private $green;

    /**
     * @var int
     *
     * @ORM\Column(name="blue", type="integer")
     */
    private $blue;

    /**
     * @var string
     *
     * @ORM\Column(name="hex", type="string", length=255)
     */
    private $hex;


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
     * Set name
     *
     * @param string $name
     *
     * @return Color
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
     * Set red
     *
     * @param integer $red
     *
     * @return Color
     */
    public function setRed($red)
    {
        $this->red = $red;

        return $this;
    }

    /**
     * Get red
     *
     * @return int
     */
    public function getRed()
    {
        return $this->red;
    }

    /**
     * Set green
     *
     * @param integer $green
     *
     * @return Color
     */
    public function setGreen($green)
    {
        $this->green = $green;

        return $this;
    }

    /**
     * Get green
     *
     * @return int
     */
    public function getGreen()
    {
        return $this->green;
    }

    /**
     * Set blue
     *
     * @param integer $blue
     *
     * @return Color
     */
    public function setBlue($blue)
    {
        $this->blue = $blue;

        return $this;
    }

    /**
     * Get blue
     *
     * @return int
     */
    public function getBlue()
    {
        return $this->blue;
    }

    /**
     * Set hex
     *
     * @param string $hex
     *
     * @return Color
     */
    public function setHex($hex)
    {
        $this->hex = $hex;

        return $this;
    }

    /**
     * Get hex
     *
     * @return string
     */
    public function getHex()
    {
        return $this->hex;
    }

    function __toString()
    {
        return $this->red."-".$this->green."-".$this->blue;
    }


}

