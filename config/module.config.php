<?php

/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf;

return array(
    'view_manager' => array(
        'strategies' => array(
            'ViewHtml2PdfStrategy',
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'ViewHtml2PdfStrategy' => 'Zff\Html2Pdf\Mvc\Service\ViewHtml2PdfStrategyFactory',
        ),
    ),
);
