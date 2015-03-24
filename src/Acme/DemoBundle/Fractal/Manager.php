<?php

namespace Acme\DemoBundle\Fractal;

use Acme\DemoBundle\Fractal\Serializer\DataArraySerializer;
use League\Fractal\Manager as baseFractalManager;
use League\Fractal\Resource\ResourceInterface;
use Acme\DemoBundle\Fractal\Scope;

/**
 * Manager
 *
 * Not a wildly creative name, but the manager is what a Fractal user will interact
 * with the most. The manager has various configurable options, and allows users
 * to create the "root scope" easily.
 */
class Manager extends baseFractalManager
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

//    /**
//     * Create Data.
//     *
//     * Main method to kick this all off. Make a resource then pass it over, and use toArray()
//     * @param ResourceInterface $resource
//     * @param null $scopeIdentifier
//     * @param \League\Fractal\Scope $parentScopeInstance
//     * @return Scope|\League\Fractal\Scope
//     */
//    public function createData(ResourceInterface $resource, $scopeIdentifier = null, \League\Fractal\Scope $parentScopeInstance = null)
//    {
//        $scopeInstance = new Scope($this, $resource, $scopeIdentifier);
//
//        // Update scope history
//        if ($parentScopeInstance !== null) {
//            // This will be the new children list of parents (parents parents, plus the parent)
//            $scopeArray = $parentScopeInstance->getParentScopes();
//            $scopeArray[] = $parentScopeInstance->getScopeIdentifier();
//
//            $scopeInstance->setParentScopes($scopeArray);
//        }
//
//        return $scopeInstance;
//    }
}
