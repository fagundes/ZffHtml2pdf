# ZffBase

Versão 0.0.1 Criado por Vinicius Fagundes.

## Introdução

## Requisitos

* Zend Framework 2
* html2pdf 

## Instalação

Inclua o trecho abaixo no arquivo `composer.json`:

```js
   "require": {
        "fagundes/zff-html2pdf":"0.0.1"
   }
```

Atualize as dependencias via composer:

```bash
   php composer.phar update
```

Inclua o modulo no arquivo `./config/application.config.php`:

```php
    'modules' => array(
       'ZffHtml2Pdf',
       'Application'
    ),
```