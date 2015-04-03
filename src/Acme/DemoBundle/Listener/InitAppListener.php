<?php

namespace Acme\DemoBundle\Listener;

use Doctrine\ORM\Mapping\Builder\EntityListenerBuilder;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Doctrine\Common\Persistence\Mapping\ClassMetadata;
/**
 * Loading webinstance and partner
 * affecting basic constants.
 */
class InitAppListener
{
    /**
     * @var Container
     */
    private $container;

    /**
     * @param Container $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param FilterControllerEvent $event
     *
     * @throws \Exception
     */
    public function onKernelController(FilterControllerEvent $event)
    {

        $this->container->setParameter('api.uri', $event->getRequest()->getUri());

    }
}
