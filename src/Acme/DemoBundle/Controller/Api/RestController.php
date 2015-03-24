<?php

namespace Acme\DemoBundle\Controller\Api;

use Doctrine\ORM\EntityNotFoundException;


use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Query;
use Doctrine\ORM\UnitOfWork;
use Doctrine\ORM\Proxy\Proxy;
use Doctrine\Common\Collections\Criteria;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;



abstract class RestController extends FOSRestController
{
    const ACTION_CREATE = 'create';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';
    const ACTION_PATCH  = 'patch';
    const CODE_WRONG_ARGS = 'GEN-FUBARGS';
    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';
    const CODE_FORBIDDEN = 'GEN-GTFO';
    /**
     * Edit entity
     *
     * @param  mixed $id
     *
     * @return Response
     */
    public function handleUpdateRequest($id)
    {
        $entity = $this->getManager()->find($id);
        if ($entity) {
            if ($this->processForm($entity)) {
                return $this->getPreparedItem($entity);
            }
            return $this->errorFormResponse();
        }
        return $this->errorNotFound();
    }

    /**
     * Create new
     *
     * @param mixed $_ [optional] Arguments will be passed to createEntity method
     *
     * @return Response
     */
    public function handleCreateRequest($_ = null)
    {
        $entity      = call_user_func_array(array($this, 'createEntity'), func_get_args());
        if ($this->processForm($entity)) {
            return $this->getPreparedItem($entity);
        }
        return $this->errorFormResponse();
    }


    /**
     * Create new entity
     *
     * @param mixed $_ [optional] Arguments will be passed to createEntity method of manager (result of getManager)
     *
     * @return mixed
     */
    protected function createEntity()
    {
        return call_user_func_array(array($this->getManager(), 'createEntity'), func_get_args());
    }

    /**
     * Process form.
     *
     * @param  mixed $entity
     *
     * @return bool
     */
    protected function processForm($entity)
    {
        $this->fixRequestAttributes();

        return $this->getFormHandler()->process($entity);
    }

    /**
     * Convert REST request to format applicable for form.
     */
    protected function fixRequestAttributes()
    {
        $request  = $this->container->get('request');
        $formName = str_replace('api_v1_', '', $this->getForm()->getName());

        $data     = empty($formName)
            ? $request->request->all()
            : $request->request->get($formName);

        // save fixed values for named form
        $request->request->set($this->getForm()->getName(), $data);
    }

    /**
     * Delete entity
     *
     * @param  mixed $id
     *
     * @return Response
     */
    public function handleDeleteRequest($id)
    {
        try {
            $this->getDeleteHandler()->handleDelete($id, $this->getManager());

            return new JsonResponse([],Codes::HTTP_NO_CONTENT);

        } catch (EntityNotFoundException $notFoundEx) {
            return $this->errorNotFound($notFoundEx->getMessage());
        } catch (\Exception $ex) {
            return $this->errorUnauthorized($ex->getMessage());
        }
    }

    /**
     * Generates a Response with a 403 HTTP header and a given message.
     *
     * @param string $message
     *
     * @return mixed
     */
    public function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)->respondWithError($message, self::CODE_FORBIDDEN);
    }

    /**
     * Generates a Response with a 500 HTTP header and a given message.
     *
     * @param string $message
     *
     * @return Response
     */
    public function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    /**
     * Generates a Response with a 404 HTTP header and a given message.
     *
     * @param string $message
     *
     * @return Response
     */
    public function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)->respondWithError($message, self::CODE_NOT_FOUND);
    }

    /**
     * Generates a Response with a 401 HTTP header and a given message.
     *
     * @param string $message
     *
     * @return Response
     */
    public function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)->respondWithError($message, self::CODE_UNAUTHORIZED);
    }

    /**
     * Generates a Response with a 400 HTTP header and a given message.
     *
     * @param string $message
     *
     * @return Response
     */
    public function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400) -> respondWithError($message, self::CODE_WRONG_ARGS);
    }

    /**
     * return error form
     */
    public function errorFormResponse(){

        return  ['form' => $this->getFormHandler()->getForm()];
    }

    /**
     * Gets an object responsible to delete an entity.
     *
     * @return DeleteHandler
     */
    protected function getDeleteHandler()
    {
        return $this->get('api.handler.delete');
    }
}
