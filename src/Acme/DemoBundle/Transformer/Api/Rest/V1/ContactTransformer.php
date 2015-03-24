<?php

namespace Acme\DemoBundle\Transformer\Api\Rest\V1;

use Acme\DemoBundle\Entity\Contact;


class ContactTransformer extends BaseTransformer
{
    /**
     * @var string
     */
    protected $currentResourceKey = 'contact';

    /**
     * List of resources possible to embed via this processor
     *
     * @var array
     */
    protected $availableIncludes = [
        'addresses',
        'rights'
    ];

    /**
     * Turn this item object into a generic array
     * @param Contact $contact
     * @return array
     */
    public function transform(Contact $contact = null)
    {
        if (is_null($contact)) {
            return [];
        }

        return [
            'id'        => (int)$contact->getId(),
            'lastname'  => $contact->getLastname(),
            'firstname' => $contact->getFirstname(),
            'links'     => $this->getLinkByEntity($contact)
        ];
    }

    /**
     * Embed Contact
     * @param Contact $contact
     * @return \League\Fractal\Resource\Item
     */
    public function includeAddresses(Contact $contact = null)
    {

        $this->setEmbed('addresses');

        $addressTransformer = new AddressTransformer($this->request, $this->getEm());

        if (empty($contact)) {
            return $this->Collection([], $addressTransformer);
        }

        $addresses = $contact->getAddresses();

        return $this->paginate($addresses, $addressTransformer);
    }

    /**
     * Embed Contact
     * @param Contact $contact
     * @return \League\Fractal\Resource\Item
     */
    public function includeRights(Contact $contact = null)
    {
        $this->setEmbed('rights');

        $rightTransformer = new RightTransformer($this->request, $this->getEm());
        $rightTransformer
            ->setCurrentScope($this->currentScope)
            ->setInputEmbedParamFetcher($this->inputEmbedParamFetcher);

        if (is_null($contact)) {
            return $this->Collection([], $rightTransformer);
        }

        $rights = $contact->getRights();

        return $this->paginate($rights, $rightTransformer);
    }


}
