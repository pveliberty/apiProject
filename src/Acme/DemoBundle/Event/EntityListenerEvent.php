<?php

namespace Acme\DemoBundle\Event;

use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\Event;

/**
 * Asset Event
 */
class EntityListenerEvent extends Event
{
    /**
     * @var LifecycleEventArgs
     */
    private $args;

//    /**
//     * @var string
//     */
//    private $objectClass;

    /**
     * @param LifecycleEventArgs $args
     */
    public function __construct(LifecycleEventArgs $args)
    {
        $this->args = $args;
//        $this->objectClass = get_class($args->getEntity());
    }

    /**
     * @return LifecycleEventArgs
     */
    public function getLifecycleEventArgs()
    {
        return $this->args;
    }

//    /**
//     * @return string
//     */
//    public function getObjectClass()
//    {
//        return $this->objectClass;
//    }

}
