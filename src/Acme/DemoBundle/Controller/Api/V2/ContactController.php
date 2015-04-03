<?php

namespace Acme\DemoBundle\Controller\Api\V2;

use Acme\DemoBundle\Controller\Api\RestGetController;
use Doctrine\ORM\Mapping\Builder\EntityListenerBuilder;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\Request\ParamFetcherInterface;
use FOS\RestBundle\View\View;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Acme\DemoBundle\Entity\Contact;
use FOS\RestBundle\Controller\Annotations\Route;

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
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     * @return array
     */
    public function getContactsAction(ParamFetcherInterface $paramFetcher)
    {
        $this->initParams($paramFetcher);

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
        $this->initParams($paramFetcher);

        return $this->handleGetRequest($id, 'contact');
    }


    /**
     * @return string
     */
    protected function getEntityName(){
        return 'contact';
    }
}
