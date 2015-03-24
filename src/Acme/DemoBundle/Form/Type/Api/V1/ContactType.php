<?php

namespace Acme\DemoBundle\Form\Type\Api\V1;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;


class ContactType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $optionDate = [
            'widget'                         => 'single_text',
            'format'                         => 'dd/MM/yyyy',
            'input'                          => 'datetime',
            'attr'                           => ['placeholder' => 'rp.forms.global.dateformat', 'startDate' => '-90y'],
        ];

        $builder
            ->add('lastname', 'text')
            ->add('firstname', 'text')
            ->add('birthdate', 'datetime', $optionDate);

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'processAddress']);
        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'processRights']);
    }

    /**
     * @param FormEvent $event
     */
    public function processRights(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (isset($data['rights'])) {
                $form->add('rights', 'entity' , [
                        'class' => 'AcmeDemoBundle:Right',
                        'multiple'=> true,
                        'property'=> 'id'
                    ]
                );
        }
    }

    /**
     * check if add the sub params address
     *
     * @param FormEvent $event
     */
    public function processAddress(FormEvent $event)
    {
        $data = $event->getData();
        $form = $event->getForm();

        if (isset($data['addresses'])) {
            if(is_array($data['addresses']) && is_array(array_shift($data['addresses']))) {
                $form->add('addresses', 'collection',
                    [
                        'type'         => new AddressType(),
                        'allow_add'    => true,
                        'allow_delete' => true,
                    ]
                );
            } else{
                $form->add('addresses', 'entity' , [
                        'class' => 'AcmeDemoBundle:Address',
                        'multiple'=> true,
                        'property'=> 'id'
                    ]
                );
            }
        }
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class'        => 'Acme\DemoBundle\Entity\Contact',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'api_v1_contact';
    }
}
