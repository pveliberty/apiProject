<?php

namespace Acme\DemoBundle\Form\Type\Api\V1;

use Symfony\Component\Form\AbstractType,
    Symfony\Component\Form\FormBuilderInterface,
    Symfony\Component\OptionsResolver\OptionsResolverInterface;

use Acme\DemoBundle\Entity\Right;
use Symfony\Component\Form\Extension\Core\ChoiceList\SimpleChoiceList;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Validator\Constraints\NotBlank;

class RightType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $attr = ['constraints'  => [new NotBlank()]];

        $builder
            ->add('shortname', 'text', $attr)
            ->add('active', 'checkbox');

        $builder->addEventListener(FormEvents::PRE_SUBMIT, [$this, 'processContact']);
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
            $form->add('contact', 'entity' , [
                    'class' => 'AcmeDemoBundle:Contact',
                    'multiple'=> false,
                    'property'=> 'id'
                ]
            );
        }

    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Acme\DemoBundle\Entity\Right',
        ]);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'api_v1_right';
    }
}