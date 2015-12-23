<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace ZffTest\Html2Pdf\View\Renderer;

use PHPUnit_Framework_TestCase as TestCase;
use Zend\View\Renderer\PhpRenderer;
use Zend\View\Resolver\TemplatePathStack;
use Zff\Html2Pdf\View\Model\Html2PdfModel;
use Zff\Html2Pdf\View\Renderer\Html2PdfRenderer;

/**
 * @author Vinicius Fagundes <mvlacerda@gmail.com>
 */
class Html2PdfRendererTest extends TestCase
{
    /**
     * @var Html2PdfRenderer
     */
    protected $renderer;

    /**
     * @var PhpRenderer
     */
    protected $phpRenderer;

    public function setUp()
    {
        $this->phpRenderer = new PhpRenderer;
        $this->renderer    = new Html2PdfRenderer();

        $this->renderer->setViewRenderer($this->phpRenderer);
    }

    public function testEngineIsIdenticalToRenderer()
    {
        $this->assertSame($this->renderer, $this->renderer->getEngine());
    }

    public function testPassingNameToResolverReturnsScriptName()
    {
        $this->renderer->resolver()->addPath(__DIR__.'/_templates');
        $filename = $this->renderer->resolver('layout.phtml');
        $this->assertEquals(realpath(__DIR__.'/_templates/layout.phtml'), $filename);
    }

    public function testResolverIsAProxyToPhpRendererResolver()
    {
        $this->assertSame($this->phpRenderer->resolver(), $this->renderer->resolver());
    }

    public function testCanSetResolverInstance()
    {
        $resolver = new TemplatePathStack();
        $this->renderer->setResolver($resolver);
        $this->assertSame($resolver, $this->renderer->resolver());

        $this->assertSame($this->phpRenderer->resolver(), $this->renderer->resolver());
    }

    public function testPassingInvalidHtmlToRenderRaisesException()
    {
        $model = new Html2PdfModel();
        $model->setTemplate('invalid.phtml');

        $this->renderer->resolver()->addPath(__DIR__.'/_templates');

        $this->setExpectedException('HTML2PDF_exception');
        $this->renderer->render($model);
    }
}
