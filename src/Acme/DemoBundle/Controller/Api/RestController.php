<?php

namespace Acme\DemoBundle\Controller\Api;

use Doctrine\ORM\EntityNotFoundException;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use FOS\RestBundle\Util\Codes;

abstract class RestController extends FOSRestController
{
    //const ENTITY_NAME = '';
    const ACTION_CREATE = 'create';
    const ACTION_UPDATE = 'update';
    const ACTION_DELETE = 'delete';
    const ACTION_PATCH = 'patch';
    const CODE_WRONG_ARGS = Codes::HTTP_BAD_REQUEST;
    const CODE_NOT_FOUND = Codes::HTTP_NOT_FOUND;
    const CODE_INTERNAL_ERROR = Codes::HTTP_INTERNAL_SERVER_ERROR;
    const CODE_UNAUTHORIZED = Codes::HTTP_UNAUTHORIZED;
    const CODE_FORBIDDEN = Codes::HTTP_FORBIDDEN;

    /**
     * Edit entity.
     *
     * @param mixed $id
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
     * Create new.
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
     * Create new entity.
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
     * @param mixed $entity
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
        $apiVersion = $this->get('router')->getContext()->getApiVersion();
        $request    = $this->container->get('request');
        $formName   = str_replace('api_'.$apiVersion.'_', '', $this->getForm()->getName());

        if (!$request->request->has($formName)) {
            throw new InvalidArgumentException('invalid request format detected');
        }

        $data = $request->request->get($formName);

        // save fixed values for named form
        $request->request->set($this->getForm()->getName(), $data);
    }

    /**
     * Delete entity.
     *
     * @param mixed $id
     *
     * @return Response
     */
    public function handleDeleteRequest($id)
    {
        try {
            $this->getDeleteHandler()->handleDelete($id, $this->getManager());

            return new JsonResponse([], Codes::HTTP_NO_CONTENT);
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
        return $this->setStatusCode(400)->respondWithError($message, self::CODE_WRONG_ARGS);
    }

    /**
     * return error form.
     */
    public function errorFormResponse()
    {
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

    /**
     * Get entity Manager
     *
     * @return ApiEntityManager
     */
    protected function getManager()
    {
        return $this->get('api.manager.'.$this->getEntityName());
    }

    /**
     * @return FormInterface
     */
    protected function getForm()
    {
        return $this->get('api.form.'.$this->getEntityName());
    }

    /**
     * @return ApiFormHandler
     */
    protected function getFormHandler()
    {
        return $this->get('api.handler.'.$this->getEntityName());
    }

    /**
     * @return AbstractTransformer
     */
    protected function getTransformer()
    {
        return $this->get('transformer.'.$this->getEntityName());
    }

    /**
     * @return null
     */
    protected function getEntityName(){
        return null;
    }
}
