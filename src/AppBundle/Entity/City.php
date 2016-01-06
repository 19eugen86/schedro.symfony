<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * City
 *
 * @ORM\Table(name="cities")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CityRepository")
 */
class City
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
     *
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @ORM\ManyToOne(targetEntity="Country", inversedBy="cities")
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id")
     *
     * @Assert\Type(type="AppBundle\Entity\Country")
     * @Assert\Valid()
     */
    protected $country;

    /**
     * @ORM\OneToMany(targetEntity="Client", mappedBy="city")
     */
    protected $clients;

    /**
     * @ORM\OneToMany(targetEntity="Factory", mappedBy="city")
     */
    protected $factories;

    /**
     * @ORM\OneToMany(targetEntity="DistributionCenter", mappedBy="city")
     */
    protected $distributionCenters;

    /**
     * @ORM\OneToMany(targetEntity="Branch", mappedBy="city")
     */
    protected $branches;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
        $this->factories = new ArrayCollection();
        $this->distributionCenters = new ArrayCollection();
        $this->branches = new ArrayCollection();
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
     * @return City
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
     * @param Country $country
     * @return $this
     */
    public function setCountry(Country $country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getCountry()
    {
        return $this->country;
    }
}

