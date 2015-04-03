<?php
namespace Acme\DemoBundle\Doctrine\Listener\Entity;

use Acme\DemoBundle\Doctrine\Listener\WebHookBaseListener;
use Acme\DemoBundle\Entity\Address;
use Doctrine\ORM\Event\LifecycleEventArgs;

class AddressListener extends WebHookBaseListener
{
    /**
     * @param Address $address
     * @param LifecycleEventArgs $args
     */
    public function postPersist(Address $address, LifecycleEventArgs $args)
    {
        parent::postPersist($args);
    }

    /**
     * @param Address $address
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(Address $address, LifecycleEventArgs $args)
    {
        parent::postUpdate($args);
    }

    /**
     * @param Address $address
     * @param LifecycleEventArgs $args
     */
    public function postRemove(Address $address, LifecycleEventArgs $args)
    {
        parent::postRemove($args);
    }
}