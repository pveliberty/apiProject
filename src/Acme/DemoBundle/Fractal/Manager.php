<?php

namespace Acme\DemoBundle\Fractal;

use Acme\DemoBundle\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Manager as BaseFractalManager;
use League\Fractal\Resource\ResourceInterface;
use Acme\DemoBundle\Fractal\Scope;

/**
 * Manager
 *
 * Not a wildly creative name, but the manager is what a Fractal user will interact
 * with the most. The manager has various configurable options, and allows users
 * to create the "root scope" easily.
 */
class Manager extends BaseFractalManager
{

    /**
     * Get Serializer.
     *
     * @return DataArraySerializer
     */
    public function getSerializer()
    {
        if (! $this->serializer) {
            $this->setSerializer(new DataArraySerializer());
        }

        return $this->serializer;
    }
}
