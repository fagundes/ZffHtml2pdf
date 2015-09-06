# ZffHtml2Pdf for Zend Framework 2

ZffHtml2Pdf module integrates [HTML2PDF](https://github.com/spipu/html2pdf) with Zend Framework 2 easily.

~~**Note** right now we are using a [fork](https://github.com/fagundes/html2pdf) from the [original](https://github.com/spipu/html2pdf) HTML2PDF library.~~

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```bash
php composer.phar require fagundes/zff-html2pdf:0.*
```

Then add `Zff\\Html2Pdf` to your `config/application.config.php`.

Installation without composer is not officially supported and requires you to manually install all dependencies that are listed in composer.json

## Usage

Controller Example: `AnyController.php`

```php
<?php

use Zff\Html2Pdf\Html2PdfModel;

class AnyController
{

    public function someAction()
    {
        //some logic here

        return new Html2PdfModel(array(
            'foo' => $foo,
            'bar' => $bar
        ));
    }

}
```

View Example: `some.phtml`

```php
<!-- Regular HTML -->
<div class="container">
    <h2>The header</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eu metus sed lacus ultrices pharetra a vitae massa.
    </p>
</div>
```

## Documentation

Check for examples and HTML / CSS support at [html2pdf.fr](http://html2pdf.fr/) and [github.com/spipu/html2pdf](https://github.com/spipu/html2pdf).