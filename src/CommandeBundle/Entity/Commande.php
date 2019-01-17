<?php

namespace CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commande
 *
 *
 * @ORM\Table(name="commande")
 * @ORM\Entity(repositoryClass="CommandeBundle\Repository\CommandeRepository")
 */
class Commande
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
     * @ORM\OneToMany(targetEntity="CommandeBundle\Entity\CommandeItem", mappedBy="commande", cascade={"persist", "remove"})
     */
    private $items;

    /**
     * @ORM\OneToOne(targetEntity="CommandeBundle\Entity\PersonalInfo", cascade={"persist", "remove"})
     */
    private $personal_info;

    /**
     * @ORM\Column(type="boolean", length=255, nullable=true)
     * @var bool
     */
    private $archived;

    public function __construct()
    {
        $this->items = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return mixed
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param mixed $items
     */
    public function setItems($items)
    {
        $this->items = $items;
    }

    /**
     * Add item
     *
     * @param \CommandeBundle\Entity\CommandeItem $item
     *
     * @return Commande
     */
    public function addItem(\CommandeBundle\Entity\CommandeItem $item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Remove item
     *
     * @param \CommandeBundle\Entity\CommandeItem $item
     */
    public function removeItem(\CommandeBundle\Entity\CommandeItem $item)
    {
        $this->items->removeElement($item);
    }

    /**
     * @return mixed
     */
    public function getPersonalInfo()
    {
        return $this->personal_info;
    }

    /**
     * @param mixed $personal_info
     */
    public function setPersonalInfo($personal_info)
    {
        $this->personal_info = $personal_info;
    }

    /**
     * @return bool
     */
    public function isArchived()
    {
        return $this->archived;
    }

    /**
     * @param bool $archived
     */
    public function setArchived($archived)
    {
        $this->archived = $archived;
    }
}
