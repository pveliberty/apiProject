<?php

namespace Acme\DemoBundle\Transformer\Api\V1;

use Acme\DemoBundle\Entity\Right;
use Acme\DemoBundle\Transformer\Api\BaseTransformer;

class RightTransformer extends BaseTransformer
{
    /**
     * @var string
     */
    protected $currentResourceKey = 'right';

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
     * @param Right $right
     *
     * @return array
     */
    public function transform(Right $right)
    {
        if (is_null($right)) {
            return [];
        }

        $response = [
            'id'        => (int) $right->getId(),
            'shortname' => $right->getShortname(),
            'active'    => $right->getActive(),
        ];

        if ($this->options['withLink']) {
            $response['links'] = $this->getLinkByEntity($right);
        }

        return $response;
    }

    /**
     * Embed Contact.
     *
     * @param Right $right
     *
     * @return \League\Fractal\Resource\Item
     */
    public function includeContacts(Right $right = null)
    {
        $this->setEmbed('contacts');

        $contactTransformer = new ContactTransformer($this->getEm());
        $contactTransformer
            ->setRequest($this->request)
            ->setOptions($this->options);

        if (is_null($right) || is_null($right->getContacts())) {
            return $this->Collection([], $contactTransformer);
        }

        $contacts = $right->getContacts();

        return $this->paginate($contacts, $contactTransformer);
    }
}
