<?php

namespace LocaleSwitch\View\Helper;

use Laminas\Validator\AbstractValidator;
use Laminas\View\Helper\AbstractHelper;

class LocaleSwitch extends AbstractHelper
{
    public function __invoke(array $locales)
    {
        $view = $this->getView();

        $translator = AbstractValidator::getDefaultTranslator();
        $locale = $translator->getDelegatedTranslator()->getLocale();

        return $view->partial('locale-switch/helper/locale-switch', ['locales' => $locales, 'currentLocale' => $locale]);
    }
}
