# ZffHtml2Pdf

Versão 0.0.1  
Criado por Vinicius Fagundes.

## Introdução

ZffHtml2Pdf é um módulo do ZendFramework 2, que facilita o uso da biblioteca [spipu/html2pdf](https://github.com/spipu/html2pdf).

**Note** que a biblioteca html2pdf utilizada é um [fork](https://github.com/fagundes/html2pdf) da biblioteca [original](https://github.com/spipu/html2pdf). 

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
return array(
    //...
    'modules' => array(
       'ZffHtml2Pdf',
       'Application'
    ),
    //...
);
```