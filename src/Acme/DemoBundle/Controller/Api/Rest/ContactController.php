<?php

namespace Acme\DemoBundle\Controller\Api\Rest;

use Acme\DemoBundle\Controller\Api\RestGetController;
use Pagerfanta\Adapter\ArrayAdapter;
use Pagerfanta\Pagerfanta;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Acme\DemoBundle\Entity\Contact;

/**
 * Rest controller for contact.
 */
class ContactController extends RestGetController
{
    /**
     * List all Contacts.
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
     * @Annotations\QueryParam(name="embed", default="addresses", description="How many notes to return.")
     * @Annotations\QueryParam(name="page", requirements="\d+", default="1", description="How many notes to return.")
     * @Annotations\QueryParam(name="perpage", requirements="\d+", default="10", description="How many notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getContactsAction(ParamFetcherInterface $paramFetcher)
    {
        $this->setParamsFetcher($paramFetcher);

        return $this->handleGetListRequest('contacts');
    }

    /**
     * Get a single contact.
     *
     * @ApiDoc(
     *   output = "Acme\DemoBundle\Model\Address",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="addresses,rights", description="How many notes to return.")
     *
     * @Annotations\View(templateVar="contact")
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @internal param int $id the contact id
     * @return array
     */
    public function getContactAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->setParamsFetcher($paramFetcher);

        return $this->handleGetRequest($id, 'contact');
    }


    /**
     * Get a single contact by the id address.
     *
     * @ApiDoc(
     *   output = "Acme\DemoBundle\Model\Contact",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="addresses", description="How man y notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @internal param int $id the address id
     *
     * @return array
     */
    public function getAddressContactAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->setParamsFetcher($paramFetcher);

        $address = $this->getDoctrine()->getManager()->getRepository('AcmeDemoBundle:Address')->find($id);

        return $this->handleGetRequest($address->getContact()->getId(), 'contact');
    }

    /**
     * Get a list contact by the id right.
     *
     * @ApiDoc(
     *   output = "Acme\DemoBundle\Model\Contact",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     * @Annotations\QueryParam(name="embed", default="addresses", description="How man y notes to return.")
     *
     * @Annotations\View()
     *
     * @param ParamFetcherInterface $paramFetcher
     *
     * @internal param int $id the right id
     *
     * @return array
     */
    public function getRightContactsAction(ParamFetcherInterface $paramFetcher, $id)
    {
        $this->setParamsFetcher($paramFetcher);

        return $this->handleGetListRequest('contact', ['rights' => [$id]]);
    }

    /**
     * Creates a new contact from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Contact",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     *
     */
    public function postContactAction()
    {
        return $this->handleCreateRequest();
    }

    /**
     * Patch a contact from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Contact",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View()
     *
     *
     */
    public function patchContactAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * Put a contact from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Acme\DemoBundle\Form\Contact",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View()
     *
     *
     */
    public function putContactAction($id)
    {
        return $this->handleUpdateRequest($id);
    }

    /**
     * REST DELETE
     *
     * @param int $id
     *
     * @ApiDoc(
     *      description="Delete Contact",
     *      resource=true
     * )
     *
     * @return Response
     */
    public function deleteContactAction($id)
    {
        return $this->handleDeleteRequest($id);
    }

    /**
     * Get entity Manager
     *
     * @return ApiEntityManager
     */
    public function getManager()
    {
        return $this->get('api.manager.contact');
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->get('api.form.contact');
    }

    /**
     * @return ApiFormHandler
     */
    public function getFormHandler()
    {
        return $this->get('api.handler.contact');
    }

    /**
     * @return AbstractTransformer
     */
    public function getTransformer()
    {
        return $this->get('contact.transformer');
    }
}
