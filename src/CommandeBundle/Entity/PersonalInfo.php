<?php

namespace CommandeBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Commande
 *
 *
 * @ORM\Table(name="personal_info")
 * @ORM\Entity(repositoryClass="CommandeBundle\Repository\PersonalInfoRepository")
 */
class PersonalInfo
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
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z]*$/",
     *     message="Invalid Name",
     * )
     *
     * @ORM\Column(name="customer_firstname", type="string", length=255, nullable=true)
     */
    private $customerFirstName;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/^[a-zA-Z]*$/",
     *     message="Invalid Last Name",
     * )
     *
     * @ORM\Column(name="customer_lastname", type="string", length=255, nullable=true)
     */
    private $customerLastName;

    /**
     * @var string
     *
     * @Assert\Regex(
     *     pattern="/\d{8}/",
     *     htmlPattern="/\d{8}/",
     *     message="Invalid Phone Number",
     * )
     *
     * @ORM\Column(name="customer_phone", type="string", length=255, nullable=true)
     */
    private $customerPhone;

    /**
     * @var string
     *
     * @Assert\Email(
     *     message = "'{{ value }}' is not a valid email.",
     *     checkMX = true,
     * )
     *
     * @ORM\Column(name="customer_email", type="string", length=255, nullable=true)
     */
    private $customerEmail;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="City can't be blank",
     * )
     *
     * @ORM\Column(name="customer_city", type="string", length=255, nullable=true)
     */
    private $customerCity;

    /**
     * @var string
     *
     * @Assert\NotBlank(
     *     message="Address can't be blank",
     * )
     *
     * @ORM\Column(name="customer_address", type="string", length=255, nullable=true)
     */
    private $customerAddress;

    /**
     * @var string
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *     pattern="/\d{4}/",
     *     message="Invalic Code",
     * )
     *
     * @ORM\Column(name="customer_postal_code", type="string", length=255, nullable=true)
     */
    private $postalCode;

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
     * @return string
     */
    public function getCustomerFirstName()
    {
        return $this->customerFirstName;
    }

    /**
     * @param string $customerFirstName
     */
    public function setCustomerFirstName($customerFirstName)
    {
        $this->customerFirstName = $customerFirstName;
    }

    /**
     * @return string
     */
    public function getCustomerLastName()
    {
        return $this->customerLastName;
    }

    /**
     * @param string $customerLastName
     */
    public function setCustomerLastName($customerLastName)
    {
        $this->customerLastName = $customerLastName;
    }

    /**
     * Set customerPhone
     *
     * @param string $customerPhone
     *
     * @return PersonalInfo
     */
    public function setCustomerPhone($customerPhone)
    {
        $this->customerPhone = $customerPhone;

        return $this;
    }

    /**
     * Get customerPhone
     *
     * @return string
     */
    public function getCustomerPhone()
    {
        return $this->customerPhone;
    }

    /**
     * Set customerEmail
     *
     * @param string $customerEmail
     *
     * @return PersonalInfo
     */
    public function setCustomerEmail($customerEmail)
    {
        $this->customerEmail = $customerEmail;

        return $this;
    }

    /**
     * Get customerEmail
     *
     * @return string
     */
    public function getCustomerEmail()
    {
        return $this->customerEmail;
    }

    /**
     * @return string
     */
    public function getCustomerCity()
    {
        return $this->customerCity;
    }

    /**
     * @param string $customerCity
     */
    public function setCustomerCity($customerCity)
    {
        $this->customerCity = $customerCity;
    }

    /**
     * @return string
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * @param string $customerAddress
     */
    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;
    }

    /**
     * @return string
     */
    public function getPostalCode()
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postalCode = $postalCode;
    }
}
