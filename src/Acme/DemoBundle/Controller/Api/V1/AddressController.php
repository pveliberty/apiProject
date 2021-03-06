<?php

namespace Acme\DemoBundle\Controller\Api\V1;

use Acme\DemoBundle\Controller\Api\RestGetController;
use Acme\DemoBundle\Manager\ApiEntityManager;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Acme\DemoBundle\Entity\Address;
use Symfony\Component\Form\FormInterface;
use FOS\RestBundle\Controller\Annotations\Route;

/**
 * Rest controller for address.
 */
class AddressController extends RestGetController
{
    /**
     * entity name
     */
    const ENTITY_NAME = 'address';

    /**
     * List all addresses.
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
     * @Annotations\QueryParam(name="embed", default="contact,contact.addresses", description="How many notes to return.")
     * @Annotations\QueryParam(name="page", requirements="\d+", default="1", description="How many notes to return.")
     * @Annotations\QueryParam(name="perpage", requirements="\d+", default="10", description="How many notes to return.")
     *
     * @Annotations\View()
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getAddressesAction(ParamFetcherInterface $paramFetcher)
    {
        $this->initParams($paramFetcher);

        return $this->handleGetListRequest('addresses');
    }

    /**
     * Get a single address.
     *
     * @ApiDoc(
     *   output = "Acme\DemoBundle\Model\Address",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="contact,contact.addresses,contact.rights", description="How man y notes to return.")
     *
     * @Annotations\View(templateVar="address")
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @internal param int $id the address id
     * @return array
     */
    public function getAddressAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleGetRequest($id, 'address');
    }

    /**
     * List all address form contact.
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
     * @Annotations\QueryParam(name="embed", default="contact", description="How many notes to return.")
     * @Annotations\QueryParam(name="page", requirements="\d+", default="1", description="How many notes to return.")
     * @Annotations\QueryParam(name="perpage", requirements="\d+", default="10", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @internal param int $id the contact id
     * @return array
     */
    public function getContactAddressesAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleGetListRequest('contact.addresses', ['contact' => $id]);
    }

    /**
     * Creates a new address from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Address",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="contact", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function postAddressAction(ParamFetcherInterface $paramFetcher)
    {
        $this->initParams($paramFetcher);

        return $this->handleCreateRequest();
    }

    /**
     * Patch a address from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Address",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="contact", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function patchAddressAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleUpdateRequest($id);
    }

    /**
     * Put a address from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Address",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="contact", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function putAddressAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->initParams($paramFetcher);

        return $this->handleUpdateRequest($id);
    }

    /**
     * REST DELETE.
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Address",
     *      resource=true
     * )
     *
     * @return Response
     */
    public function deleteAddressAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * @return string
     */
    protected function getEntityName(){
        return 'address';
    }
}
