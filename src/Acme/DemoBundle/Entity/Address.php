<?php

namespace Acme\DemoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;

use JMS\Serializer\Annotation\ExclusionPolicy,
    JMS\Serializer\Annotation\Expose,
    JMS\Serializer\Annotation\Groups,
    JMS\Serializer\Annotation\Accessor;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="Address")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Address
{

    /**
     * id
     */
    protected $id;

    /**
     * @var string $title
     *
     * @ORM\Column(name="title", type="string", nullable=false)
     */
    protected $title;

    /**
     * @var string
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $company;

    /**
     * @Expose
     * @Groups({"apiv1", "internal"})
     * @var string
     */
    protected $lastname;

    /**
     * @Expose
     * @Groups({"apiv1", "internal"})
     * @var string
     */
    protected $firstname;

    /**
     * @var string
     * @Expose
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $address1;

    /**
     * @var string
     * @Expose
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $address2;


    /**
     * @var string
     * @Expose
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $address3;


    /**
     * @var string
     * @Expose
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $zipcode;

    /**
     * @var string
     * @Expose
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $city;

    /**
     * @var integer
     */
    protected $version;

    /**
     * @var double
     * @Expose
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $latitude;

    /**
     * @var double
     * @Expose
     * @Groups({"front_cart", "apiv1", "internal"})
     */
    protected $longitude;

    /**
     * @var boolean
     * @Expose
     * @Groups({"apiv1", "internal"})
     */
    protected $active = true;

    /**
     * @var boolean
     * @Expose
     * @Groups({"apiv1", "internal"})
     */
    protected $default = false;

    /**
     * @var Contact
     *
     */
    protected $contact;

    /**
     * @var string
     * @Expose
     * @Groups({"front_cart", "apiv1"})
     */
    protected $country;

    /**
     * @var string
     */
    protected $externalId;

    /**
     * @Expose
     *
     *
     * @var \DateTime
     * @Groups({"search","api", "apiv1", "internal", "elastica"})
     */
    protected $createdAt ;

    /**
     * @Expose
     * @Groups({"search","api", "apiv1", "internal" })
     *
     * @var \DateTime
     */
    protected $updatedAt;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }

    /**
     * @param $id
     * @return $this
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * Set title
     *
     * @param string $title
     * @return Address
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set name
     *
     * @param string $lastname
     * @return Address
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     * @return Address
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }


    /**
     * Set address1
     *
     * @param string $address1
     * @return Address
     */
    public function setAddress1($address1)
    {
        $this->address1 = $address1;

        return $this;
    }

    /**
     * Get address1
     *
     * @return string
     */
    public function getAddress1()
    {
        return $this->address1;
    }

    /**
     * Set address2
     *
     * @param string $address2
     * @return Address
     */
    public function setAddress2($address2)
    {
        $this->address2 = $address2;

        return $this;
    }

    /**
     * Get address2
     *
     * @return string
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * Set address3
     *
     * @param string $address3
     * @return Address
     */
    public function setAddress3($address3)
    {
        $this->address3 = $address3;

        return $this;
    }

    /**
     * Get address3
     *
     * @return string
     */
    public function getAddress3()
    {
        return $this->address3;
    }

    /**
     * Set zipcode
     *
     * @param string $zipcode
     * @return Address
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    /**
     * Get zipcode
     *
     * @return string
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Set city
     *
     * @param string $city
     * @return Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set version
     *
     * @param integer $version
     * @return Address
     */
    public function setVersion($version)
    {
        $this->version = $version;

        return $this;
    }

    /**
     * Get version
     *
     * @return integer
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Address
     */
    public function setActive($active)
    {
        $this->active = $active;

        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function isActive()
    {
        return $this->active;
    }

    /**
     * Set default
     *
     * @param boolean $default
     * @return Address
     */
    public function setDefault($default)
    {
        $this->default = $default;

        return $this;
    }

    /**
     * Set longitude
     *
     * @param double $longitude
     * @return Address
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return double
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set latitude
     *
     * @param double $latitude
     * @return Address
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return double
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Get default
     *
     * @return boolean
     */
    public function isDefault()
    {
        return $this->default;
    }

    /**
     * Set Contact
     *
     * @param \Acme\DemoBundle\Entity\Contact $contact
     * @return $this|Address
     */
    public function setContact(Contact $contact)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \Acme\DemoBundle\Entity\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set country
     *
     * @param string $country
     * @return Address
     */
    public function setCountry($country)
    {
        $this->country = $country;

        return $this;
    }

    /**
     * Get country
     *
     * @return string
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Gets the value of company.
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Sets the value of company.
     *
     * @param string $company the company
     *
     * @return self
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Set externalid
     *
     * @param string $externalid
     * @return Contact
     */
    public function setExternalid($externalid)
    {
        $this->externalId = $externalid;

        return $this;
    }

    /**
     * Get externalid
     *
     * @return string
     */
    public function getExternalid()
    {
        return $this->externalId;
    }

    /**
     * Remove contact on an address
     */
    public function removeContact()
    {
        $this->contact = null;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     *
     * @return $this
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTime $updatedAt
     *
     * @return $this
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }



}
