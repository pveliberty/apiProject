<?php

/*
 * This file is part of the League\Fractal package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 **/

namespace Acme\DemoBundle\Fractal;

use League\Fractal\Scope as BaseFractalScope;
use InvalidArgumentException;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Resource\ResourceInterface;
use League\Fractal\Serializer\SerializerAbstract;

/**
 * Scope
 *
 * The scope class acts as a tracker, relating a specific resource in a specific
 * context. For example, the same resource could be attached to multiple scopes.
 * There are root scopes, parent scopes and child scopes.
 */
class Scope extends BaseFractalScope
{
//    /**
//     * Fire the main transformer.
//     *
//     * @internal
//     *
//     * @param TransformerAbstract|callable $transformer
//     * @param mixed                        $data
//     *
//     * @return array
//     */
//    protected function fireTransformer($transformer, $data)
//    {
//        $options = $this->manager->getOptions();
//        $transformer->setOptions($options);
//
//        parent::fireTransformer($transformer,$data);
//    }
}
