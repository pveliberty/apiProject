<?php

namespace Acme\DemoBundle\Transformer\Api\Rest\V1;

use Acme\DemoBundle\Entity\Address;

class AddressTransformer extends BaseTransformer
{
    /**
     * @var string
     */
    protected $currentResourceKey = 'addresse';

    /**
     * List of resources possible to embed via this processor
     *
     * @var array
     */
    protected $availableIncludes = [
        'contact'
    ];

    /**
     * Turn this item object into a generic array
     * @param Address $address
     * @return array
     */
    public function transform(Address $address)
    {
        return [
            'id'        => (int)$address->getId(),
            'title'     => $address->getTitle(),
            'lastname'  => $address->getLastname(),
            'firstname' => $address->getFirstname(),
            'address1'  => $address->getAddress1(),
            'address2'  => $address->getAddress2(),
            'zipcode'   => $address->getZipcode(),
            'city'      => $address->getCity(),
            'country'   => $address->getCountry(),
            'links'     => $this->getLinkByEntity($address)
        ];
    }

    /**
     * Embed Contact
     * @param Address $address
     * @return \League\Fractal\Resource\Item
     */
    public function includeContact(Address $address)
    {
        $this->setEmbed('contact');

        $contact = $address->getContact();

        $transformer = new ContactTransformer($this->request, $this->getEm());

        return $this->item($contact, $transformer);
    }
}
