<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Department
 *
 * @ORM\Table(name="departments")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\DepartmentRepository")
 */
class Department
{
    const FACTORY = 'factory';
    const DISTRIBUTION_CENTER = 'distribution_center';
    const BRANCH = 'branch';

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
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    private $address;

    /**
     * @var City
     *
     * @ORM\ManyToOne(targetEntity="City", inversedBy="departments")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\City")
     * @Assert\Valid()
     */
    private $city;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", columnDefinition="ENUM('factory', 'distribution_center', 'branch')")
     */
    private $type = 'branch';

    /**
     * @var ArrayCollection
     *
     * @ORM\OneToMany(targetEntity="Warehouse", mappedBy="department")
     */
    private $warehouses;

    public function __construct()
    {
        $this->warehouses = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Department
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
     * Set description
     *
     * @param string $description
     *
     * @return Department
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Department
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
     * Set city
     *
     * @param City $city
     *
     * @return Department
     */
    public function setCity(City $city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return City
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Department
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    public function getRoutePart()
    {
        $type = $this->getType();
        switch ($type) {
            case self::FACTORY:
                $routePart = 'factories';
                break;

            case self::DISTRIBUTION_CENTER:
                $routePart = 'distribution_centers';
                break;

            case self::BRANCH:
                $routePart = 'branches';
                break;

            default:
                $routePart = '';
                break;
        }
        return $routePart;
    }

    public function __toString() {
        return $this->name;
    }
}

