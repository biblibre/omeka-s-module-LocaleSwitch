<?php

namespace LocaleSwitch\Mvc;

use Laminas\EventManager\AbstractListenerAggregate;
use Laminas\EventManager\EventManagerInterface;
use Laminas\Mvc\MvcEvent;
use Laminas\Session\Container;
use Laminas\Validator\AbstractValidator;

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
