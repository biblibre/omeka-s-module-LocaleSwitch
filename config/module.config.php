<?php

namespace LocaleSwitch;

return [
    'controllers' => [
        'invokables' => [
            'LocaleSwitch\Controller\Site\Index' => Controller\Site\IndexController::class,
        ],
    ],
    'listeners' => [
        'LocaleSwitch\MvcListeners',
    ],
    'router' => [
        'routes' => [
            'site' => [
                'child_routes' => [
                    'set-locale' => [
                        'type' => \Zend\Router\Http\Literal::class,
                        'options' => [
                            'route' => '/set-locale',
                            'defaults' => [
                                '__NAMESPACE__' => 'LocaleSwitch\Controller\Site',
                                'controller' => 'Index',
                                'action' => 'set-locale',
                            ],
                        ],
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'invokables' => [
            'LocaleSwitch\MvcListeners' => Mvc\MvcListeners::class,
        ]
    ],
    'view_helpers' => [
        'invokables' => [
            'localeSwitch' => View\Helper\LocaleSwitch::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            dirname(__DIR__) . '/view',
        ],
    ],
];
