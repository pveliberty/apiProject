<?php

/*
 * This file is part of the League\Fractal package.
 *
 * (c) Phil Sturgeon <me@philsturgeon.uk>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Acme\DemoBundle\Fractal\Serializer;

use League\Fractal\Pagination\PaginatorInterface;
use League\Fractal\Serializer\DataArraySerializer as baseDataArraySerializer;

class DataArraySerializer extends baseDataArraySerializer
{
    /**
     * Serialize an item.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function item($resourceKey, array $data)
    {
        return $data;
    }

    /**
     * Serialize the paginator.
     *
     * @param PaginatorInterface $paginator
     *
     * @return array
     */
    public function paginator(PaginatorInterface $paginator)
    {
        if ((int)$paginator->getTotal() === 0) {
            return [];
        }

        $currentPage = (int)$paginator->getCurrentPage();
        $lastPage    = (int)$paginator->getLastPage();

        $pagination = [
            'total'        => (int)$paginator->getTotal(),
//            'count'        => (int)$paginator->getCount(),
            'perpage'      => (int)$paginator->getPerPage(),
            'page'         => $currentPage,
            'total_pages'  => $lastPage,
            'offset_start' => (int)$paginator->getPaginator()->getCurrentPageOffsetStart(),
            'offset_end'   => (int)$paginator->getPaginator()->getCurrentPageOffsetEnd(),
        ];

        $pagination['links'] = [];

        if ($currentPage > 1) {
            $pagination['links']['previous'] = $paginator->getUrl($currentPage - 1);
        }

        if ($currentPage < $lastPage) {
            $pagination['links']['next'] = $paginator->getUrl($currentPage + 1);
        }

        return [$pagination];
    }

    /**
     * Serialize a collection.
     *
     * @param string $resourceKey
     * @param array $data
     *
     * @return array
     */
    public function collection($resourceKey, array $data)
    {

        if (empty($data)) {
            return [];
        }

        return ['data' => $data];
    }
}
