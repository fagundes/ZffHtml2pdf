# Configuring html2pdf constructor

## 1. Default values from config file

Optionally, you can change the default values for html2pdf
constructor by adding this configuration to your `./config/autoload/global.php`.

Note, you don't need set all options, only those you need to override.

```php
<?php
return [
    'zff-html2pdf' => [
        //HTML2PDF factory options
        'options' => [
            'orientation' => 'P',
            'format'      => 'A4',
            'lang'        => 'en',
            'unicode'     => true,
            'encoding'    => 'UTF-8',
            'margins'      => [0, 0, 0, 0],
        ],
    ],
];
```

## 2. Change default values in controller

Another way to change the default values for html2pdf constructor in a single action is overriding
the options by setting them in `Html2PdfModel` like below.

Note, these options will be merged with the options defined on config file.
It will override the config file when necessary.

```php
<?php

use Zff\Html2Pdf\View\Model\Html2PdfModel;

MyController
{

    public function myAction()
    {
        $model = new Html2PdfModel();
        $model->setHtml2PdfOptions([
            'orientation' => 'P',
            'format'      => 'A4',
            'lang'        => 'en',
            'unicode'     => true,
            'encoding'    => 'UTF-8',
            'margins'      => [0, 0, 0, 0],
        ]);

        return $model;
    }
}

```