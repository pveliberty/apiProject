<?php

namespace Acme\DemoBundle\Controller\Api;

use Acme\DemoBundle\Fractal\Scope;
use Acme\DemoBundle\Transformer\Api\Rest\V1\BaseTransformer;
use FOS\RestBundle\Request\ParamFetcherInterface;
use League\Fractal\Pagination\PagerfantaPaginatorAdapter;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use Acme\DemoBundle\Fractal\Manager;
use FOS\RestBundle\Controller\FOSRestController;
use Pagerfanta\Pagerfanta;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

/**
 * @property Manager fractal
 */
class RestGetController extends RestController
{

    /**
     * var BaseTransformer
     */
    protected $transformer;

    /**
     * @var int
     */
    protected $limit = 100;

    /**
     * @var null
     */
    protected $offset = null;
    /**
     * @var int
     */
    protected $perpage = 10;

    /**
     * @var array
     */
    protected $orderby = [];
    /**
     * @var null
     */
    protected $page = 1;

    /**
     * @var array
     */
    protected $optionEmbed = [];

    /**
     * @var int
     */
    protected $statusCode = 200;

    /**
     * @var string
     */
    protected $embeds;

    /**
     * @param ParamFetcherInterface $paramFetcher
     */
    public function setParamsFetcher(ParamFetcherInterface $paramFetcher)
    {
        $this->fractal = new Manager();

        foreach ($paramFetcher->all() as $key => $param) {
            if ($key === 'embed') {
                $embeds = $this->getEmbedsWithoutOptions($paramFetcher);
                $embeds = $this->getEmbedsWithSubEmbed($embeds);

                // Are we going to try and include embedded data?
                $this->fractal->parseIncludes($embeds);
                continue;
            }

            if (!is_null($param)) {
                if ($key === 'orderby') {
                    if (!is_array($param)) {
                        $param = (array)json_decode(str_replace('=', ':', $param));
                    }
                }
                $this->$key              = $param;
                $this->optionEmbed[$key] = $param;
            }
        }
    }

    /**
     * @param array $embeds
     *
     * @return array
     */
    private function getEmbedsWithSubEmbed($embeds = [])
    {
        $responseEmbed = [];
        foreach ($embeds as $embed) {
            if (strpos($embed, '.') === false) {
                $responseEmbed[$embed] = $embed;
                continue;
            }
            $tabEmbeds = explode('.', $embed);
            $parent    = '';
            foreach ($tabEmbeds as $tabEmbed) {
                $valueEmbed                 = empty($parent) ? $tabEmbed : $parent . '.' . $tabEmbed;
                $responseEmbed[$valueEmbed] = $valueEmbed;
                $parent                     = $valueEmbed;
            }
        }

        return array_values($responseEmbed);
    }

    /**
     * @param ParamFetcherInterface $paramFetcher
     *
     * @return array
     */
    private function getEmbedsWithoutOptions(ParamFetcherInterface $paramFetcher)
    {
        $this->embeds = $paramFetcher->get('embed');
        $datas        = [];
        preg_match_all('|{(.*)}|U', $this->embeds, $datas);
        $embeds = $this->embeds;
        foreach ($datas[1] as $data) {
            $embeds = str_replace('{' . $data . '}', "", $this->embeds);
        }

        return explode(',', $embeds);
    }

    /**
     * @return int
     */
    public function getStatusCode()
    {
        return $this->statusCode;
    }

    /**
     * @param $statusCode
     *
     * @return $this
     */
    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;

        return $this;
    }

    /**
     * GET single item
     *
     * @param  mixed $id
     *
     * @return Response
     */
    public function handleGetRequest($id, $resourceKey)
    {
        $manager = $this->getManager();

        $result = $manager->find($id);

        if (empty($result)) {
            return $this->errorNotFound();
        }

        return $this->getPreparedItem($result, $resourceKey);
    }

    /**
     * {@inheritdoc}
     */
    public function handleGetListRequest($resourceKey, $filters = [])
    {
        $manager = $this->getManager();

        $qb = $manager->getListQueryBuilder($this->limit, $this->page, $filters, $this->orderby, $this->offset);

        $result = $this->getPreparedItems($manager->getPaginator($qb), $resourceKey);

        return $result;
    }

    /**
     * @param $item
     * @param $resourceKey
     * @return mixed
     */
    protected function getPreparedItem($item, $resourceKey = null)
    {
        if (empty($this->transformer)) {
            $this->transformer = $this->getTransformer();
        }

        if (empty($this->fractal)) {
            $this->fractal = new Manager();
        }

        $resource = new Item($item, $this->transformer);

        $rootScope = $this->fractal->createData($resource, $resourceKey);

        $this->transformer
            ->setCurrentScope($rootScope)
            ->setInputEmbedParamFetcher($this->embeds);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param Pagerfanta $collection
     * @param $resourceKey
     * @internal param BaseTransformer $callback
     *
     * @return mixed
     */
    protected function getPreparedItems(Pagerfanta $collection, $resourceKey = null)
    {
        if (empty($this->transformer)) {
            $this->transformer = $this->getTransformer();
        }

        if (empty($this->fractal)) {
            $this->fractal = new Manager();
        }

        $collection->setMaxPerPage($this->perpage)
            ->setCurrentPage($this->page);

        $resource = new Collection($collection, $this->transformer);

        $adapter = $this->getAdapter($collection);

        $resource->setPaginator($adapter);

        $rootScope = $this->fractal->createData($resource, $resourceKey);

        $this->transformer
            ->setCurrentScope($rootScope)
            ->setInputEmbedParamFetcher($this->embeds);

        return $this->respondWithArray($rootScope->toArray());
    }

    /**
     * @param array $array
     * @param array $headers
     *
     * @return mixed
     */
    protected function respondWithArray(array $array, array $headers = [])
    {
        return new JsonResponse($array, $this->statusCode, $headers);
    }

    /**
     * @param $message
     * @param $errorCode
     *
     * @return mixed
     */
    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }

        return $this->respondWithArray([
            'error' => [
                'code'      => $errorCode,
                'http_code' => $this->statusCode,
                'message'   => $message,
            ],
        ]);
    }


    /**
     * @param $ressource
     * @return PagerfantaPaginatorAdapter
     */
    private function getAdapter($ressource)
    {
        $inputEmbedParamFetcher = !empty($this->embeds) ? 'embed=' . $this->embeds : '?';
        $baseUri                = $uri = urldecode($this->getRequest()->getUri());

        $adatpter = new PagerfantaPaginatorAdapter($ressource, function ($page) use ($baseUri, $inputEmbedParamFetcher) {
            //delete white space into uri
            $uriBaseTrim = str_replace(' ', '', $baseUri);
            //find if base uri have the ? carac for deduct the prefixe
            $prefixe = array_search('?', str_split($baseUri)) !== false ? '&' : '?';

            $newUri = preg_match('/[&|?]page=\d+/', $uriBaseTrim) ?
                preg_replace('/page=\d+/', 'page=' . $page, $uriBaseTrim) :
                $uriBaseTrim . $prefixe . 'page=' . $page;

            return urldecode($newUri);
        });

        return $adatpter;
    }

}
