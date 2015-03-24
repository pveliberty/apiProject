<?php
namespace Acme\DemoBundle\Entity;

use JMS\Serializer\Annotation\ExclusionPolicy,
    JMS\Serializer\Annotation\Expose,
    JMS\Serializer\Annotation\Groups,
    JMS\Serializer\Annotation\MaxDepth,
    JMS\Serializer\Annotation\Type,
    JMS\Serializer\Annotation\Accessor;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
/**
 * @ORM\Table(name="Right")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 */
class Right
{

    /**
     * id
     */
    protected $id;

    /**
     *
     * @var string
     */
    protected $shortname;

    /**
     *
     * @var boolean
     */
    protected $active;

    /**
     * @var ArrayCollection
     */
    protected $contacts;

    /**
     * @var string
     */
    protected  $configuration = "";


    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    /**
     * Set shortname
     *
     * @param string $shortname
     * @return Right
     */
    public function setShortname($shortname)
    {
        $this->shortname = $shortname;

        return $this;
    }

    /**
     * Get shortname
     *
     * @return string
     */
    public function getShortname()
    {
        return $this->shortname;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Right
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
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Add contact
     *
     * @param ContactInterface $contact
     * @return Right
     */
    public function addContact(ContactInterface $contact)
    {
        $this->contacts->add($contact);

        return $this;
    }

    /**
     * Remove contact
     *
     * @param ContactInterface $contact
     */
    public function removeContact(ContactInterface $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contact
     *
     * @return ArrayCollection
     */
    public function getContacts()
    {
        return $this->contacts;
    }

    /**
     * @param ArrayCollection $contacts
     *
     * @return $this
     */
    public function setContacts($contacts)
    {
        $this->contacts = $contacts;

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

    /**
     * @return array
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param array $configuration
     *
     * @return $this
     */
    public function setConfiguration($configuration)
    {
        $this->configuration = $configuration;

        return $this;
    }

}
