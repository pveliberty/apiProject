<?php

namespace Acme\DemoBundle\Transformer\Api\V1;

use Acme\DemoBundle\Entity\Contact;
use Acme\DemoBundle\Transformer\Api\BaseTransformer;

class ContactTransformer extends BaseTransformer
{
    /**
     * @var string
     */
    protected $currentResourceKey = 'contact';

    /**
     * List of resources possible to embed via this processor.
     *
     * @var array
     */
    protected $availableIncludes = [
        'addresses',
        'rights',
    ];

    /**
     * Turn this item object into a generic array.
     *
     * @param Contact $contact
     *
     * @return array
     */
    public function transform(Contact $contact = null)
    {
        if (is_null($contact)) {
            return [];
        }

        $response = [
            'id'        => (int) $contact->getId(),
            'lastname'  => $contact->getLastname(),
            'firstname' => $contact->getFirstname()
        ];

        if ($this->options['withLink']) {
            $response['links'] = $this->getLinkByEntity($contact);
        }

        return $response;
    }

    /**
     * Embed Contact.
     *
     * @param Contact $contact
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeAddresses(Contact $contact = null)
    {
        $this->setEmbed('addresses');

        $addressTransformer = new AddressTransformer($this->getEm());
        $addressTransformer
            ->setRequest($this->request)
            ->setOptions($this->options);

        if (empty($contact)) {
            return $this->Collection([], $addressTransformer);
        }

        $addresses = $contact->getAddresses();

        return $this->paginate($addresses, $addressTransformer);
    }

    /**
     * Embed Contact.
     *
     * @param Contact $contact
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeRights(Contact $contact = null)
    {
        $this->setEmbed('rights');

        $rightTransformer = new RightTransformer($this->getEm());
        $rightTransformer
            ->setRequest($this->request)
            ->setOptions($this->options);

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
