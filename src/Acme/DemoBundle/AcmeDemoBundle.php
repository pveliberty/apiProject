<?php

namespace Acme\DemoBundle;

use Acme\DemoBundle\DependencyInjection\Compiler\AddParameterPass;
use Acme\DemoBundle\DependencyInjection\Compiler\DoctrineEntityListenerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class AcmeDemoBundle extends Bundle
{

    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        $container->addCompilerPass(new DoctrineEntityListenerPass());
    }
}
