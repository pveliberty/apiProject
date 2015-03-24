<?php

namespace Acme\DemoBundle\Handler\Api\V1;

use Acme\DemoBundle\Entity\Address;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Request;
use Acme\DemoBundle\Entity\Contact;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ContactHandler
{
    /**
     * @var FormInterface
     */
    public $form;
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
     * @param Request $request
     * @param ObjectManager $manager
     */
    public function __construct(FormInterface $form, Request $request, ObjectManager $manager)
    {
        $this->form        = $form;
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
     * @param  Contact $contact
     *
     * @return bool True on successful processing, false otherwise
     */
    public function process(Contact $contact)
    {
        $method = $this->request->getMethod();
        $this->form->setData($contact);
        if (in_array($method, ['POST', 'PUT', 'PATCH'])) {
            $this->form->submit($this->request, 'PATCH' !== $method);
            if ($this->form->isValid()) {
                foreach($contact->getAddresses() as $address){
                    $address->setContact($contact);
                }
                $this->onSuccess($contact);
                return true;
            }
        }
        return false;
    }

    /**
     * "Success" form handler
     *
     * @param Contact $contact
     */
    protected function onSuccess(Contact $contact)
    {
        try{
            $this->manager->persist($contact);
            $this->manager->flush();
        } catch(\Exception $e){
            var_dump($e->getMessage());exit;
        }
    }
}