<?php

namespace Acme\DemoBundle\Listener;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class ApiLanguageListener
{
    /**
     * @var Session
     */
    private $session;

    /**
     * @var array
     */
    private $languages = ['en', 'de', 'fr'];

    /**
     * @param Session $session
     */
    public function setSession(Session $session)
    {
        $this->session = $session;
    }

    /**
     * @param GetResponseEvent $event
     */
    public function setLocale(GetResponseEvent $event)
    {
        $request = $event->getRequest();

        $request->setLocale($request->getPreferredLanguage($this->languages));
    }
}
