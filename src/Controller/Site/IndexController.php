<?php

namespace LocaleSwitch\Controller\Site;

use Laminas\Mvc\Controller\AbstractActionController;
use Laminas\Session\Container;

class IndexController extends AbstractActionController
{
    public function setLocaleAction()
    {
        $locale = $this->params()->fromQuery('locale');
        $redirect_url = $this->params()->fromQuery('redirect_url');

        if ($locale) {
            $session = Container::getDefaultManager()->getStorage();
            $session->offsetSet('locale', $locale);
        }

        if ($redirect_url && !strncmp($redirect_url, "/", 1)) {
            return $this->redirect()->toUrl($redirect_url);
        }

        return $this->redirect()->toRoute('site', [], [], true);
    }
}
