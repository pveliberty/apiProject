<?php

namespace Acme\DemoBundle\Entity;
use Hateoas\Configuration\Annotation as Hateoas;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\Expose;
use JMS\Serializer\Annotation\Groups;
use JMS\Serializer\Annotation\VirtualProperty;
use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\SerializedName;
use Doctrine\ORM\Mapping as ORM;


/**
 * @ORM\Table(name="Contact")
 * @ORM\Entity()
 * @ORM\HasLifecycleCallbacks()
 * @Hateoas\Relation("self", href = "expr('/contact/' ~ object.getId())")
 */
class  Contact
{

    /**
     * id
     */
    protected $id;

    /**
     * @var string
     *
     * @Expose
     */
    protected $lastname;

    /**
     * @var string
     *
     * @Expose
     */
    protected $firstname;

    /**
     * @var string
     */
    protected $lastnameCanonical;

    /**
     * @var string
     */
    protected $firstnameCanonical;

    /**
     * @var \Datetime
     *
     * @Expose
     */
    protected $birthdate;

    /**
     * @var string
     */
    protected $externalId;

    /**
     * @var string
     */
    protected $gender;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $status = 'active';

    /**
     * @var \Datetime
     */
    protected $studentAt;

    /**
     * @var boolean
     */
    protected $student = false;

    /**
     * @var \Datetime
     */
    protected $enrolledAt;

    /**
     * @var \Datetime
     */
    protected $terminatedAt;

    /**
     * @var \Datetime
     */
    protected $renewedAt;

    /**
     * @var \Datetime
     */
    protected $insuredAt;

    /**
     * @var boolean
     */
    protected $insured = false;

    /**
     * @var string
     *
     * @Expose
     * @Groups({"api", "apiv1", "internal"})
     * @Type("string")
     */
    protected $phone;

    /**
     * @var string
     *
     * @Expose
     * @Groups({"api", "apiv1", "internal"})
     * @Type("string")
     */
    protected $mobile;

    /**
     * @var string
     *
     * @Expose
     * @Groups({"api", "apiv1", "internal", "elastica"})
     * @Type("string")
     */
    protected $email;

    /**
     * @var boolean
     *
     * @Expose
     * @Groups({"api", "apiv1", "internal"})
     * @Type("boolean")
     */
    protected $optIn = false;

    /**
     * @var boolean
     * @Expose
     * @Groups({"api", "apiv1", "internal"})
     * @Type("boolean")
     */
    protected $partnerOptin = false;

    /**
     * @var ArrayCollection
     */
    protected $addresses;


    /**
     * @var ArrayCollection
     */
    protected $rights;

    /**
     * @var Contact
     */
    protected $payer;

    /**
     * @var boolean
     */
    protected $acceptPartnerCommercial = false;

    /**
     * @var string
     */
    protected $g7crmCode;

    /**
     * @var string
     */
    protected $externalReference;

    /**
     * @var string
     */
    protected $oldIdContact;

    /**
     * @var array
     */
    protected $data;

    /**
     * @var string
     */
    protected $externalGuid;

    /**
     * @var string
     */
    protected $hash;

    /**
     * @var boolean
     */
    protected $dirty = false;

    /**
     * @var integer
     */
    protected $assetBalance;

    /**
     * @var string
     */
    protected $pictureName;

    /**
     * @var string
     */
    protected $preferentialCode;

    /**
     * @var ExternalNumber
     */
    protected $externalNumber;

    /**
     * @Expose
     *
     *
     * @var \DateTime
     * @Groups({"search","api", "apiv1", "internal", "elastica"})
     */
    protected $createdAt;

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
        $collections = [
            'addresses', 'rights',
        ];

        foreach ($collections as $col) {
            $this->$col = new ArrayCollection();
        }

        $this->createdAt = new \DateTime('now');
        $this->updatedAt = new \DateTime('now');
    }
    /**
     * To string def method.
     *
     * @return string
     */
    public function __toString()
    {
        $bDate = (null !== $this->getBirthdate())
            ? ' ('.$this->getBirthdate()->format('d/m/Y').')'
            : '';

        return $this->getFirstname().' '.$this->getLastname().$bDate;
    }

    /**
     * Set lastname.
     *
     * @param string $lastname
     *
     * @return Contact
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
        $this->computeHash();

        return $this;
    }

    /**
     * get the name of the picture of the contact.
     *
     * @return string
     */
    public function getPictureName()
    {
        foreach ($this->getDocuments() as $document) {
            if ($document->getType() === DocumentType::PICTURE) {
                return $document->getFilename();
            }
        }
    }

    /**
     * @param string $pictureName
     *
     * @return $this
     */
    public function setPictureName($pictureName)
    {
        $this->pictureName = $pictureName;

        return $this;
    }

    /**
     * Get lastname.
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set firstname.
     *
     * @param string $firstname
     *
     * @return Contact
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
        $this->computeHash();

        return $this;
    }

    /**
     * Get firstname.
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set canonical lastname.
     *
     * @param string $canonicalLastname
     *
     * @return Contact
     */
    public function setLastnamecanonical($canonicalLastname)
    {
        $this->lastnameCanonical = $canonicalLastname;

        return $this;
    }

    /**
     * Get canonical lastname.
     *
     * @return string
     */
    public function getLastnamecanonical()
    {
        return $this->lastnameCanonical;
    }

    /**
     * Set canonical firstname.
     *
     * @param string $canonicalFirstname
     *
     * @return Contact
     */
    public function setFirstnamecanonical($canonicalFirstname)
    {
        $this->firstnameCanonical = $canonicalFirstname;

        return $this;
    }

    /**
     * Get canonical firstname.
     *
     * @return string
     */
    public function getFirstnamecanonical()
    {
        return $this->firstnameCanonical;
    }

    /**
     * Set birthdate.
     *
     * @param \DateTime $birthdate
     *
     * @return Contact
     */
    public function setBirthdate(\DateTime $birthdate = null)
    {
        $this->birthdate = $birthdate;
        $this->computeHash();

        return $this;
    }

    /**
     * Get birthdate.
     *
     * @return \DateTime
     */
    public function getBirthdate()
    {
        return $this->birthdate;
    }

    /**
     * @VirtualProperty
     * @SerializedName("age")
     * @Groups({"skierslist"})
     *
     * @return integer
     */
    public function getAge()
    {
        if (null !== $this->getBirthdate()) {
            $carbon = $this->getBirthdate();

            return $carbon->age;
        }

        return 0;
    }

    /**
     * Get hash.
     *
     * @return string
     */
    public function getHash()
    {
        return $this->hash;
    }

    /**
     * Set hash.
     *
     * @param null $notUsed
     *
     * @return Contact
     */
    public function setHash($notUsed = null)
    {
        $this->computeHash();

        return $this;
    }

    /**
     * calcul the hash for this contact:.
     */
    public function computeHash()
    {
        $this->setLastnamecanonical($this->lastname);
        $this->setFirstnamecanonical($this->firstname);

        $this->hash = sha1(
            $this->firstnameCanonical.
            $this->lastnameCanonical.
            (($this->birthdate instanceof \DateTime) ? $this->birthdate->format('Y-m-d') : '')
        );

        return $this->hash;
    }

    /**
     * Set externalid.
     *
     * @param string $externalid
     *
     * @return Contact
     */
    public function setExternalid($externalid)
    {
        $this->externalId = $externalid;

        return $this;
    }

    /**
     * Get externalid.
     *
     * @return string
     */
    public function getExternalid()
    {
        return $this->externalId;
    }

    /**
     * Set gender.
     *
     * @param string $gender
     *
     * @return Contact
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender.
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set language.
     *
     * @param string $language
     *
     * @return Contact
     */
    public function setLanguage($language)
    {
        $this->language = $language;

        return $this;
    }

    /**
     * Get language.
     *
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Contact
     */

    /**
     * Set status.
     *
     * @param string $status
     *
     * @return Contact
     *
     * @throws \InvalidArgumentException
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status.
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set studentAt.
     *
     * @param \DateTime $studentAt
     *
     * @return Contact
     */
    public function setStudentat(\DateTime $studentAt = null)
    {
        $this->studentAt = $studentAt;

        return $this;
    }

    /**
     * Get studentAt.
     *
     * @return \DateTime
     */
    public function getStudentat()
    {
        return $this->studentAt;
    }

    /**
     * Set enrolledAt.
     *
     * @param \DateTime $enrolledAt
     *
     * @return Contact
     */
    public function setEnrolledat(\DateTime $enrolledAt = null)
    {
        $this->enrolledAt = $enrolledAt;

        return $this;
    }

    /**
     * Get enrolledAt.
     *
     * @return \DateTime
     */
    public function getEnrolledat()
    {
        return $this->enrolledAt;
    }

    /**
     * Set student.
     *
     * @param boolean $student
     *
     * @return Contact
     */
    public function setStudent($student)
    {
        /* TODO : refactor with rp_boolean will return bool value and not string value */
        $this->student = filter_var($student, FILTER_VALIDATE_BOOLEAN);

        if ($this->student) {
            if (!isset($this->studentAt)) {
                $this->studentAt = new \DateTime();
            }
        } else {
            $this->studentAt = null;
        }

        return $this;
    }

    /**
     * Get student.
     *
     * @return boolean
     */
    public function isStudent()
    {
        return !empty($this->studentAt);
    }

    /**
     * Set phone.
     *
     * @param string $phone
     *
     * @return Contact
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get phone.
     *
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set mobile.
     *
     * @param string $mobile
     *
     * @return Contact
     */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;

        return $this;
    }

    /**
     * Get mobile.
     *
     * @return string
     */
    public function getMobile()
    {
        return $this->mobile;
    }

    /**
     * Set email.
     *
     * @param string $email
     *
     * @return Contact
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email.
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Add addresses.
     *
     * @param Address $address
     *
     * @return Contact
     */
    public function addAddresse(Address $address)
    {
        $this->addresses->add($address);
        $address->setContact($this);

        return $this;
    }

    /**
     * Remove addresses.
     *
     * @param Address $addresses
     */
    public function removeAddresse(Address $addresses)
    {
        $this->addresses->removeElement($addresses);
    }

    /**
     * Get addresses.
     *
     * @return ArrayCollection
     */
    public function getAddresses()
    {
        return $this->addresses;
    }

    /**
     * Set addresses.
     *
     * @param ArrayCollection $addresses
     */
    public function setAddresses(ArrayCollection $addresses)
    {
        $this->addresses = $addresses;
    }

    /**
     * Get default address.
     *
     * @return AddressInterface $address
     */
    public function getDefaultaddress()
    {
        if ($this->addresses->count()) {
            if ($this->addresses->count() === 1) {
                return $this->addresses->first();
            } else {
                foreach ($this->addresses as $address) {
                    if ($address->isDefault()) {
                        return $address;
                    }
                }
            }
        }

        return;
    }

    /**
     * Set payer.
     *
     * @param Contact $payer
     *
     * @return Contact
     */
    public function setPayer(Contact $payer = null)
    {
        $this->payer = $payer;

        return $this;
    }

    /**
     * is payer.
     *
     * @return boolean
     */
    public function isPayer()
    {
        return empty($this->payer) ? true : false;
    }

    /**
     * Get payer.
     *
     * @return Contact
     */
    public function getPayer()
    {
        return $this->payer;
    }

    /**
     * Set terminatedAt.
     *
     * @param \DateTime $terminatedAt
     *
     * @return Contact
     */
    public function setTerminatedat(\DateTime $terminatedAt = null)
    {
        $this->terminatedAt = $terminatedAt;

        return $this;
    }

    /**
     * Get terminatedAt.
     *
     * @return \DateTime
     */
    public function getTerminatedat()
    {
        return $this->terminatedAt;
    }

    /**
     * Set renewedAt.
     *
     * @param \DateTime $renewedAt
     *
     * @return Contact
     */
    public function setRenewedat(\DateTime $renewedAt = null)
    {
        $this->renewedAt = $renewedAt;

        return $this;
    }

    /**
     * Get renewedAt.
     *
     * @return \DateTime
     */
    public function getRenewedat()
    {
        return $this->renewedAt;
    }

    /**
     * Set insuredAt.
     *
     * @param \DateTime $insuredAt
     *
     * @return Contact
     */
    public function setInsuredAt(\DateTime $insuredAt = null)
    {
        $this->insuredAt = $insuredAt;

        return $this;
    }

    /**
     * Get insuredAt.
     *
     * @return \DateTime
     */
    public function getInsuredAt()
    {
        return $this->insuredAt;
    }

    /**
     * Set insured.
     *
     * @param boolean $insured
     *
     * @return Contact
     */
    public function setInsured($insured)
    {
        $this->insured = $insured;

        if ($insured) {
            if (!isset($this->insuredAt)) {
                $this->insuredAt = new \DateTime();
            }
        } else {
            $this->insuredAt = null;
        }

        return $this;
    }

    /**
     * Get insured.
     *
     * @return boolean
     */
    public function isInsured()
    {
        if (!isset($this->insuredAt)) {
            return false;
        }

        return true;
    }


    /**
     * Gets the value of optIn.
     *
     * @return boolean
     */
    public function getOptin()
    {
        return $this->optIn;
    }

    /**
     * Sets the value of optIn.
     *
     * @param boolean $optIn the opt in
     *
     * @return Contact
     */
    public function setOptin($optIn)
    {
        $this->optIn = $optIn;

        return $this;
    }

    /**
     * Gets the value of optIn.
     *
     * @return boolean
     */
    public function getPartneroptin()
    {
        return $this->partnerOptin;
    }

    /**
     * Sets the value of optIn.
     *
     * @param boolean $optIn the opt in
     *
     * @return self
     */
    public function setPartneroptin($optIn)
    {
        $this->partnerOptin = $optIn;

        return $this;
    }

    /**
     * Set the value of acceptPartnerCommercial.
     *
     * @param boolean $acceptPartnerCommercial the accept partner commercial
     *
     * @return self
     */
    public function setAcceptPartnerCommercial($acceptPartnerCommercial)
    {
        $this->acceptPartnerCommercial = $acceptPartnerCommercial;

        return $this;
    }

    /**
     * Gets the value of acceptPartnerCommercial.
     *
     * @return boolean
     */
    public function getAcceptPartnerCommercial()
    {
        return $this->acceptPartnerCommercial;
    }

    /**
     * Set G7 CRM Code.
     *
     * @param string $g7crmCode
     *
     * @return Contact
     */
    public function setG7crmCode($g7crmCode)
    {
        $this->g7crmCode = $g7crmCode;

        return $this;
    }

    /**
     * Get G7 CRM Code.
     *
     * @return string
     */
    public function getG7crmCode()
    {
        return $this->g7crmCode;
    }

    /**
     * Set External Reference.
     *
     * @param string $externalReference
     *
     * @return Contact
     */
    public function setExternalReference($externalReference)
    {
        $this->externalReference = $externalReference;

        return $this;
    }

    /**
     * Get G7 CRM Code.
     *
     * @return string
     */
    public function getExternalReference()
    {
        return $this->externalReference;
    }

    /**
     * Set title.
     *
     * @param $title ContactTitleType
     *
     * @return $this
     *
     * @throws \InvalidArgumentException
     */
    public function setTitle($title)
    {
        if (!ContactTitleType::isValid($title)) {
            throw new \InvalidArgumentException("Invalid contact title");
        }

        $this->title = $title;

        return $this;
    }

    /**
     * Get title.
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set old IdContact.
     *
     * @param $oldIdContact
     *
     * @return $this
     */
    public function setOldIdContact($oldIdContact)
    {
        $this->oldIdContact = $oldIdContact;

        return $this;
    }

    /**
     * Get old IdContact.
     *
     * @return string
     */
    public function getOldIdContact()
    {
        return $this->oldIdContact;
    }

    /**
     * Add data.
     *
     * @param $data
     *
     * @return $this
     */
    public function addData($data)
    {
        $this->data[] = $data;

        return $this;
    }

    /**
     * Get data.
     *
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * Set external GUID.
     *
     * @param string $externalGuid
     *
     * @return self
     */
    public function setExternalGuid($externalGuid)
    {
        $this->externalGuid = $externalGuid;

        return $this;
    }

    /**
     * Get external GUID.
     *
     * @return string
     */
    public function getExternalGuid()
    {
        return $this->externalGuid;
    }

    /**
     * @return boolean
     */
    public function isDirty()
    {
        return $this->dirty;
    }

    /**
     * @param boolean $dirty
     *
     * @return $this
     */
    public function setDirty($dirty)
    {
        $this->dirty = $dirty;

        return $this;
    }

    /**
     * Set assetBalance.
     *
     * @param integer $assetBalance
     *
     * @return Contact
     */
    public function setAssetbalance($assetBalance)
    {
        $this->assetBalance = $assetBalance;

        return $this;
    }

    /**
     * Get asset balance.
     */
    public function calculateAssetbalance()
    {
        $balance = 0;

        foreach ($this->assets as $asset) {
            if ($asset->getCredit() > 0) {
                $balance += $asset->getCredit();
            } elseif ($asset->getDebit() > 0) {
                $balance -= $asset->getDebit();
            }
        }

        $this->assetBalance = $balance;
    }

    /**
     * @return string
     */
    public function getPreferentialcode()
    {
        return $this->preferentialCode;
    }

    /**
     * @param $preferentialCode
     *
     * @return $this
     */
    public function setPreferentialcode($preferentialCode)
    {
        $this->preferentialCode = $preferentialCode;

        return $this;
    }

    /**
     * Check if a contact has completed affiliated orders.
     *
     * @return bool
     */
    public function hasCompletedAffiliatedOrders()
    {
        return (count($this->getCompletedAffiliatedOrders()) > 0) ? true : false;
    }

    /**
     * @return string
     *
     * @VirtualProperty()
     * @Groups({"elastica"})
     */
    public function getFullContact()
    {
        return $this->getLastnamecanonical().' '.$this->getFirstnamecanonical();
    }

    /**
     * @return string
     */
    public function getContactLastnameFirstname()
    {
        return $this->getLastname().' '.$this->getFirstname();
    }

    /**
     * @VirtualProperty()
     * @Groups({"elastica"})
     */
    public function getCanonicalContact()
    {
        $f = $this->getFullContact();
        if (null !== $f) {
            return strtolower(str_replace(' ', '', $f));
        }

        return;
    }

    /**
     * @param ExternalNumber $externalNumber
     *
     * @return $this
     */
    public function setExternalNumber($externalNumber)
    {
        $this->externalNumber = $externalNumber;

        return $this;
    }

    /**
     * @return ExternalNumber
     */
    public function getExternalNumber()
    {
        return $this->externalNumber;
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
     * Add right
     *
     * @param Right $right
     * @return Contact
     */
    public function addRight(Right $right)
    {
        $this->right->add($right);
        $right->setContact($this);

        return $this;
    }

    /**
     * remove right
     *
     * @param Right $right
     */
    public function removeRight(Right $right)
    {
        $this->right->removeElement($right);
    }

    /**
     * Get addresses
     *
     * @return ArrayCollection
     */
    public function getRights()
    {
        return $this->rights;
    }
}
