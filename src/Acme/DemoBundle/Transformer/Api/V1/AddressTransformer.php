<?php

namespace Acme\DemoBundle\Transformer\Api\V1;

use Acme\DemoBundle\Entity\Address;
use Acme\DemoBundle\Transformer\Api\BaseTransformer;

class AddressTransformer extends BaseTransformer
{
    /**
     * @var string
     */
    protected $currentResourceKey = 'addresse';

    /**
     * List of resources possible to embed via this processor.
     *
     * @var array
     */
    protected $availableIncludes = [
        'contact',
    ];

    /**
     * Turn this item object into a generic array.
     *
     * @param Address $address
     *
     * @param bool $withLink
     * @return array
     */
    public function transform(Address $address)
    {
        if (is_null($address)) {
            return [];
        }

        $response = [
            'id'        => (int) $address->getId(),
            'title'     => $address->getTitle(),
            'lastname'  => $address->getLastname(),
            'firstname' => $address->getFirstname(),
            'address1'  => $address->getAddress1(),
            'address2'  => $address->getAddress2(),
            'zipcode'   => $address->getZipcode(),
            'city'      => $address->getCity(),
            'country'   => $address->getCountry(),
        ];

        if ($this->options['withLink']) {
            $response['links'] = $this->getLinkByEntity($address);
        }

        return $response;
    }

    /**
     * Embed Contact.
     *
     * @param Address $address
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeContact(Address $address)
    {
        $this->setEmbed('contact');

        $contact = $address->getContact();

        $contactTransformer = new ContactTransformer($this->getEm());
        $contactTransformer
            ->setRequest($this->request)
            ->setOptions($this->options);

        return $this->item($contact, $contactTransformer);
    }

}
