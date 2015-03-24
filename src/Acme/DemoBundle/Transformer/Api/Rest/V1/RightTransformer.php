<?php

namespace Acme\DemoBundle\Transformer\Api\Rest\V1;

use Acme\DemoBundle\Entity\Right;
use Doctrine\Common\Collections\ArrayCollection;


class RightTransformer extends BaseTransformer
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
        'contact'
    ];

    /**
     * Turn this item object into a generic array
     * @param Right $right
     * @return array
     */
    public function transform(Right $right)
    {
        return [
            'id'        => (int)$right->getId(),
            'shortname' => $right->getShortname(),
            'active'    => $right->getActive(),
            'links'     => $this->getLinkByEntity($right)
        ];
    }

    /**
     * Embed Contact
     * @param Right $right
     * @return \League\Fractal\Resource\Item
     */
    public function includeContacts(Right $right = null)
    {
        $this->setEmbed('contacts');

        $contactTransformer = new ContactTransformer($this->request, $this->getEm());

        if(is_null($right) || is_null($right->getContacts())){
            return $this->Collection([], $contactTransformer);
        }

        $contacts = $right->getContacts();

        return $this->paginate($contacts, $contactTransformer);
    }
}
