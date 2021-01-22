<?php

namespace LocaleSwitch\Mvc;

use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\MvcEvent;
use Zend\Session\Container;
use Zend\Validator\AbstractValidator;

class MvcListeners extends AbstractListenerAggregate
{
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events->attach(
            MvcEvent::EVENT_BOOTSTRAP,
            [$this, 'bootstrapLocale']
        );
    }

    public function bootstrapLocale(MvcEvent $event)
    {
        $locale = null;

        $session = Container::getDefaultManager()->getStorage();
        if ($session->offsetExists('locale')) {
            $locale = $session->offsetGet('locale');
        }

        if ($locale) {
            $services = $event->getApplication()->getServiceManager();
            $translator = $services->get('MvcTranslator');

            if (extension_loaded('intl')) {
                \Locale::setDefault($locale);
            }
            $translator->getDelegatedTranslator()->setLocale($locale);

            // Enable automatic translation for validation error messages.
            AbstractValidator::setDefaultTranslator($translator);
        }
    }
}
