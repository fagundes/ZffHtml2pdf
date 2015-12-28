[![Latest Unstable Version](https://img.shields.io/packagist/vpre/fagundes/zff-html2pdf.svg)](https://packagist.org/packages/fagundes/zff-html2pdf)
[![Build Status](https://travis-ci.org/fagundes/ZffHtml2pdf.svg?branch=develop)](https://travis-ci.org/fagundes/ZffHtml2pdf)
[![Coverage Status](https://coveralls.io/repos/fagundes/ZffHtml2pdf/badge.svg?branch=develop&service=github)](https://coveralls.io/github/fagundes/ZffHtml2pdf?branch=develop)

[![Latest Stable Version](https://img.shields.io/packagist/v/fagundes/zff-html2pdf.svg)](https://packagist.org/packages/fagundes/zff-html2pdf)
[![Build Status](https://travis-ci.org/fagundes/ZffHtml2pdf.svg?branch=0.3.0)](https://travis-ci.org/fagundes/ZffHtml2pdf)
[![Coverage Status](https://coveralls.io/repos/fagundes/ZffHtml2pdf/badge.svg?branch=0.3.0&service=github)](https://coveralls.io/github/fagundes/ZffHtml2pdf?branch=0.3.0)

[![Total Downloads](https://poser.pugx.org/fagundes/zff-html2pdf/downloads)](https://packagist.org/packages/fagundes/zff-html2pdf) [![License](https://poser.pugx.org/fagundes/zff-html2pdf/license)](https://packagist.org/packages/fagundes/zff-html2pdf)

Zff Html2Pdf for Zend Framework 2
===================================

`Zff\Html2Pdf` module integrates [HTML2PDF](https://github.com/spipu/html2pdf) with Zend Framework 2 easily.

## Installation

Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```bash
php composer.phar require fagundes/zff-html2pdf:0.*
```

Then add `Zff\\Html2Pdf` to your `config/application.config.php`.

Installation without composer is not officially supported and requires you to manually install all dependencies that are listed in composer.json

## Contribuing

If you want to help check the contribuing instructions [here](CONTRIBUTING.md).

## TODO

- [x] Bump the PHP minimum version to 5.4+
- [x] Create more unit tests
- [ ] Rewrite html2pdf examples using `Zff\Html2Pdf`
- [ ] Create a way to easily change params from HTML2PDF's constructor, called on `Html2PdfRenderer` class, on controller, view  or config file.

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