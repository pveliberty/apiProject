<?php

namespace Acme\DemoBundle\Listener;

//use Symfony\Component\HttpKernel\DependencyInjection\ContainerAwareHttpKernel;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;

/**
 * Loading webinstance and partner
 * affecting basic constants
 *
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
     * @throws \Exception
     */
    public function onKernelController(FilterControllerEvent $event)
    {
        $this->container->setParameter('api.uri',$event->getRequest()->getUri());
    }
}
