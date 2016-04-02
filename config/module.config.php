<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf;

use Zend\ServiceManager\Factory\InvokableFactory;

return [
    'view_manager'    => [
        'strategies' => [
            'ViewHtml2PdfStrategy',
        ],
    ],
    'service_manager' => [
        'factories'  => [
            Html2PdfFactory::class => InvokableFactory::class,
            'ViewHtml2PdfStrategy' => Mvc\Service\ViewHtml2PdfStrategyFactory::class,
        ],
    ],
];
