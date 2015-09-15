<?php

/**
 * @license http://opensource.org/licenses/MIT MIT  
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf\View\Renderer;

use HTML2PDF as Html2Pdf;
use HTML2PDF_exception as Html2PdfException;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Resolver\ResolverInterface as Resolver;

/**
 * Class that transforms the html of the view in pdf using HTML2PDF library and outputs it.
 */
class Html2PdfRenderer implements Renderer {

    protected $viewRenderer;

    /**
     * Template resolver
     *
     * @var Resolver
     */
    private $__templateResolver;

    /**
     * @return Renderer
     */
    public function getViewRenderer() {
        return $this->viewRenderer;
    }

    public function setViewRenderer(Renderer $viewRenderer) {
        $this->viewRenderer = $viewRenderer;
        return $this;
    }

    public function render($nameOrModel, $values = null) {
        try {
            /**
             * @todo a way to easly change this params on controller, view  and/or config file
             */
            //create html2pdf class with default params but no margins
            $html2pdf = new Html2Pdf('P', 'A4', 'en', true, 'UTF-8', array(0, 0, 0, 0));

            //set the variable html2pdf on the view
            $nameOrModel->setVariable('html2pdf', $html2pdf);

            //render the .phtml to html
            $content = $this->getViewRenderer()->render($nameOrModel, $values);
            
            //convert to PDF
            $html2pdf->WriteHTML($content);

            // send the PDF
            return $html2pdf->Output($nameOrModel->getFilename(), $nameOrModel->getDest());
        } catch (Html2PdfException $exp) {
            //show exception as string
            echo $exp;
            return false;
        }
    }

    /**
     * Return the template engine object
     *
     * Returns the object instance, as it is its own template engine
     *
     * @return Html2PdfRenderer
     */
    public function getEngine() {
        return $this;
    }

    /**
     * Set script resolver
     *
     * @param  Resolver $resolver
     * @return PhpRenderer
     * @throws Exception\InvalidArgumentException
     */
    public function setResolver(Resolver $resolver) {
        $this->__templateResolver = $resolver;
        return $this;
    }

}
