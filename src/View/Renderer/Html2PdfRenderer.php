<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf\View\Renderer;

use HTML2PDF as Html2Pdf;
use HTML2PDF_exception as Html2PdfException;
use Zend\View\Renderer\RendererInterface as Renderer;
use Zend\View\Renderer\PhpRenderer as ViewRenderer;
use Zend\View\Resolver\ResolverInterface as Resolver;
use Zff\Html2Pdf\Html2PdfFactory;
use Zff\Html2Pdf\View\Model\Html2PdfModel;

/**
 * Class that transforms the html of the view in pdf using HTML2PDF library and outputs it.
 */
class Html2PdfRenderer implements Renderer
{
    /**
     * @var ViewRenderer
     */
    protected $viewRenderer;

    /**
     * @var array
     */
    protected $defaultHtml2pdfOptions;

    /**
     * @return ViewRenderer
     */
    public function getViewRenderer()
    {
        return $this->viewRenderer;
    }

    public function setViewRenderer(ViewRenderer $viewRenderer)
    {
        $this->viewRenderer = $viewRenderer;

        return $this;
    }

    /**
     * @return array
     */
    public function getDefaultHtml2pdfOptions()
    {
        return $this->defaultHtml2pdfOptions;
    }

    /**
     * @param array $defaultHtml2pdfOptions
     */
    public function setDefaultHtml2pdfOptions($defaultHtml2pdfOptions)
    {
        $this->defaultHtml2pdfOptions = $defaultHtml2pdfOptions;
    }

    /**
     * Set script resolver
     *
     * @param  Resolver $resolver
     * @return Html2PdfRenderer
     */
    public function setResolver(Resolver $resolver)
    {
        return $this->getViewRenderer()->setResolver($resolver);
    }

    /**
     * Retrieve template name or template resolver
     *
     * @param  null|string $name
     * @return string|Resolver
     */
    public function resolver($name = null)
    {
        return $this->getViewRenderer()->resolver($name);
    }

    /**
     * Return the template engine object
     *
     * Returns the object instance, as it is its own template engine
     *
     * @return Html2PdfRenderer
     */
    public function getEngine()
    {
        return $this;
    }

    /**
     * @param mixed $nameOrModel
     * @param mixed $values
     * @return string
     * @throws Html2PdfException
     */
    public function render($nameOrModel, $values = null)
    {
        $html2pdf = $this->createHtml2pdf($nameOrModel);

        //set the variable html2pdf on the view
        $nameOrModel->setVariable('html2pdf', $html2pdf);

        //render the .phtml to html
        $content = $this->getViewRenderer()->render($nameOrModel, $values);

        //convert to PDF
        $html2pdf->WriteHTML($content);

        // send the PDF
        return $html2pdf->Output($nameOrModel->getFilename(), $nameOrModel->getDest());
    }

    /**
     * @param mixed $nameOrModel
     * @return Html2Pdf
     */
    protected function createHtml2pdf($nameOrModel)
    {
        $options = $nameOrModel instanceof Html2PdfModel && !empty($nameOrModel->getHtml2PdfOptions()) ?
            $nameOrModel->getHtml2PdfOptions() :
            $this->getDefaultHtml2pdfOptions();

        return Html2PdfFactory::factory($options);
    }
}
