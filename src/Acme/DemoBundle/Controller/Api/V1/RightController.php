<?php

namespace Acme\DemoBundle\Controller\Api\V1;

use Acme\DemoBundle\Controller\Api\RestGetController;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Acme\DemoBundle\Entity\Right;

/**
 * Rest controller for right.
 */
class RightController extends RestGetController
{
    /**
     * List all rights.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, description="How many notes to return.")
     * @Annotations\QueryParam(name="orderby", default={"id"="asc"}, nullable=true, description="How many notes to return.")
     * @Annotations\QueryParam(name="embed", default="contacts,contacts.addresses", description="How many notes to return.")
     * @Annotations\QueryParam(name="page", requirements="\d+", default="1", description="How many notes to return.")
     * @Annotations\QueryParam(name="perpage", requirements="\d+", default="10", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getRightsAction(ParamFetcherInterface $paramFetcher)
    {
        $this->initParams($paramFetcher);

        return $this->handleGetListRequest('rights');
    }

    /**
     * Get a single right.
     *
     * @ApiDoc(
     *   output = "Acme\DemoBundle\Model\Address",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="contacts,contacts.addresses", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @internal param int $id the right id
     *
     * @return array
     */
    public function getRightAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleGetRequest($id, 'right');
    }

    /**
     * List all right for contact.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing notes.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", nullable=true, description="How many notes to return.")
     * @Annotations\QueryParam(name="orderby", default={"id"="asc"}, nullable=true, description="How many notes to return.")
     * @Annotations\QueryParam(name="embed", default="contacts", description="How many notes to return.")
     * @Annotations\QueryParam(name="page", requirements="\d+", default="1", description="How many notes to return.")
     * @Annotations\QueryParam(name="perpage", requirements="\d+", default="10", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     * @internal param int $id the contact id
     * @return array
     */
    public function getContactRightsAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleGetListRequest('rights' , ['contacts' => [$id]]);
    }

    /**
     * Creates a new right from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Right",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="embed", default="contacts,contacts.addresses", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postRightAction(ParamFetcherInterface $paramFetcher)
    {
        $this->initParams($paramFetcher);

        return $this->handleCreateRequest();
    }

    /**
     * Patch a right from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Right",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="embed", default="contacts,contacts.addresses", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function patchRightAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleUpdateRequest($id);
    }

    /**
     * Put a right from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Right",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="embed", default="contacts,contacts.addresses", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return \Symfony\Component\HttpFoundation\Response
     *
     */
    public function putRightAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleUpdateRequest($id);
    }

    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Right",
     *      resource=true
     * )
     *
     * @return Response
     */
    public function deleteRightAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * @return string
     */
    protected function getEntityName(){
        return 'right';
    }
}
