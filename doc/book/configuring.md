# Configuring html2pdf constructor

Optionally, you can change the default values for html2pdf
constructor by adding this configuration to your `./config/autoload/global.php`.

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