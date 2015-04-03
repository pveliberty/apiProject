<?php
namespace Acme\DemoBundle\Doctrine\Listener\Entity;

use Acme\DemoBundle\Doctrine\Listener\WebHookBaseListener;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Acme\DemoBundle\Entity\Contact;

class ContactListener extends WebHookBaseListener
{
    /**
     * @param Contact            $contact
     * @param LifecycleEventArgs $args
     */
    public function postPersist(Contact $contact, LifecycleEventArgs $args)
    {
        parent::postPersist($args);
    }

    /**
     * @param Contact            $contact
     * @param LifecycleEventArgs $args
     */
    public function postUpdate(Contact $contact, LifecycleEventArgs $args)
    {
        parent::postUpdate($args);
    }

    /**
     * @param Contact            $contact
     * @param LifecycleEventArgs $args
     */
    public function postRemove(Contact $contact, LifecycleEventArgs $args)
    {
        parent::postRemove($args);
    }
}
