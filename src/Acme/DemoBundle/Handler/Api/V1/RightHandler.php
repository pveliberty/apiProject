<?php

namespace Acme\DemoBundle\Handler\Api\V1;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Entity\Right;

class RightHandler
{
    /**
     * @var FormInterface
     */
    protected $form;
    /**
     * @var Request
     */
    protected $request;
    /**
     * @var ObjectManager
     */
    protected $manager;

    /**
     *
     * @param FormInterface $form
     * @param Request       $request
     * @param ObjectManager $manager
     */
    public function __construct(FormInterface $form, Request $request, ObjectManager $manager)
    {
        $this->form    = $form;
        $this->request = $request;
        $this->manager = $manager;
    }

    /**
     * Process form
     *
     * @param  Right $entity
     *
     * @return bool True on successful processing, false otherwise
     */
    public function process(Right $entity)
    {
        $this->form->setData($entity);
        $method = $this->request->getMethod();

        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $this->form->submit($this->request, 'PATCH' !== $method);
            if ($this->form->isValid()) {

                $this->onSuccess($entity);
                return true;
            }
        }
        return false;
    }

    /**
     * "Success" form handler
     *
     * @param Right $entity
     */
    protected function onSuccess(Right $entity)
    {
        try{
            $this->manager->persist($entity);
            $this->manager->flush();
        } catch(\Exception $e){
            var_dump($e->getMessage());exit;
        }
    }
}