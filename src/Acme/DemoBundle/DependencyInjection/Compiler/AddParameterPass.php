<?php

namespace Acme\DemoBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Add a new twig.form.resources
 *
 * @author Philippe vesin
 */
class AddParameterPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
//        $uri = $container->get('request')->getUri();
        //$container->setParameter('api.uri', 'dd');
    }
}
