<?php

namespace Acme\DemoBundle\Form\Type\Api\V1;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class AddressType extends AbstractType
{

    /**
     * @inheritdoc
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text',
            [
                'label'    => 'rp.notr.forms.contact.address_title',
                'attr'     => array('class' => '', 'placeholder' => '')
            ]);

        $builder->add('lastname', 'text',
            [
                'label'    => 'rp.notr.forms.contact.lastname',

                'attr'     => array('class' => '', 'placeholder' => '')
            ]);

        $builder->add('firstname', 'text',
            [
                'label'    => 'rp.notr.forms.contact.firstname',
                'attr'     => array('class' => '', 'placeholder' => '')
            ]);

        $builder->add('address1', 'text',
            [
                'label'                    => 'rp.notr.forms.contact.address',
                'attr'                     => array('class' => '', 'placeholder' => '')
            ]);

        $builder->add('address2', 'text',
            [
                'label'    => 'rp.notr.forms.contact.address2',
                'attr'     => array('class' => '')
            ]);

        $builder->add('zipcode', 'text',
            [
                'label'                    => 'rp.notr.forms.contact.zipcode',
                'attr'                     => array('class' => '', 'placeholder' => '')
            ]);

        $builder->add('city', 'text',
            [
                'label'                    => 'rp.notr.forms.contact.city',
                'attr'                     => array('class' => '', 'placeholder' => '')
            ]);

        $builder->add('country', 'country',
            [
                'label'             => 'rp.notr.forms.contact.country',
                'empty_value'       => 'rp.notr.forms.contact.country.empty',
                'preferred_choices' => ['FR'],
                'expanded'          => false,
            ]);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'processContact']);
        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'processId']);
    }

    /**
     * check if add the id field for address
     *
     * @param FormEvent $event
     */
    public function processId(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (isset($data['id'])) {
            $form->add('id', 'hidden');
        }
    }

    /**
     * check if add the sub params address
     *
     * @param FormEvent $event
     */
    public function processContact(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (isset($data['contact'])) {
            if(is_array($data['contact'])) {
                $form->add('contact', new ContactType());
            } else {
                $form->add('contact', 'entity' , [
                        'class' => 'AcmeDemoBundle:Contact',
                        'multiple'=> false,
                        'property'=> 'id'
                    ]
                );
            }
        }

    }


    /**
     * @return string
     */
    public function getName()
    {
        return 'api_v1_address';
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'       => 'Acme\DemoBundle\Entity\Address',
        ]);
    }
}
