# Quick Start

The Zff Html2pdf is a simple wrapper to easily integrates the [spipu/html2pdf](https://github.com/spipu/html2pdf) library to Zend Framework.
It creates a Html2PdfStrategy to get a ordinary `.phtml` template and returns it as a `.pdf` file.

## 1. Install Zff\Html2pdf


Installation of this module uses composer. For composer documentation, please refer to
[getcomposer.org](http://getcomposer.org/).

```bash
php composer.phar require fagundes/zff-html2pdf:0.*
```

Then add `Zff\\Html2Pdf` to your `config/application.config.php`.

Installation without composer is not officially supported and requires you to manually install all dependencies that are listed in composer.json

## 2. Usage

### 2.1. Ready to Go

This module comes ready to go. You need to return a `Html2PdfModel` in your controller action, instead of a `ViewModel` or an `array`.
And create your view template `.phtml` for that action. And that's it, your view will be rendered as a `.pdf` file!

### 2.2. Simple Example

Controller: `AnyController.php`

```php
<?php

use Zff\Html2Pdf\View\Model\Html2PdfModel;

class AnyController
{

    public function someAction()
    {
        //some logic here

        return new Html2PdfModel([
            'foo' => $foo,
            'bar' => $bar
        ]);
    }

}
```

View: `some.phtml`

```php
<!-- Regular HTML -->
<div class="container">
    <h2>The header</h2>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus eu metus sed lacus ultrices pharetra a vitae massa.
    </p>
</div>
```