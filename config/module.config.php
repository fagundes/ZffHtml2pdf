<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf;

return [
    'view_manager' => [
        'strategies' => [
            'ViewHtml2PdfStrategy',
        ],
    ],
    'service_manager' => [
        'factories' => [
            'ViewHtml2PdfStrategy' => 'Zff\Html2Pdf\Mvc\Service\ViewHtml2PdfStrategyFactory',
        ],
    ],
];
