<?php

namespace Acme\DemoBundle\Handler\Api\V1;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Entity\Address;

class AddressHandler
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
     * @param FormInterface $formContact
     * @param Request $request
     * @param ObjectManager $manager
     */
    public function __construct(FormInterface $form, FormInterface $formContact, Request $request, ObjectManager $manager)
    {
        $this->form        = $form;
        $this->formContact = $formContact;
        $this->request     = $request;
        $this->manager     = $manager;
    }

    /**
     * @return FormInterface
     */
    public function getForm()
    {
        return $this->form;
    }

    /**
     * Process form
     *
     * @param Address $address
     *
     * @return bool True on successful processing, false otherwise
     */
    public function process(Address $address)
    {
        $method = $this->request->getMethod();
        $this->form->setData($address);
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $this->form->submit($this->request, 'PATCH' !== $method);
            if ($this->form->isValid()) {
                $this->onSuccess($address);
                return true;
            }
        }
        return false;
    }



    /**
     * "Success" form handler
     *
     * @param Address $address
     */
    protected function onSuccess(Address $address)
    {
        $this->manager->persist($address);
        $this->manager->flush();
    }
}