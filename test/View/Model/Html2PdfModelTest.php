<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace ZffTest\Html2Pdf\View\Model;

use PHPUnit_Framework_TestCase as TestCase;
use Zff\Html2Pdf\View\Model\Html2PdfModel;

/**
 * @author Vinicius Fagundes <mvlacerda@gmail.com>
 */
class Html2PdfModelTest extends TestCase
{

    /**
     * @var Html2PdfModel
     */
    protected $model;

    protected function setUp()
    {
        $this->model = new Html2PdfModel(array(
            'foo' => 'bar'
        ));

        $this->model->setFilename('myNewDoc.pdf');
        $this->model->setDest('D');
    }

    public function testAllowsEmptyConstructor()
    {
        $model = new Html2PdfModel();
        $this->assertInstanceOf('Zend\View\Variables', $model->getVariables());
        $this->assertEquals(array(), $model->getOptions());
    }

    public function testIsTerminateModelAsDefault()
    {
        $model = new Html2PdfModel();
    }

    public function testDefaultAttributeValue()
    {
        $model = new Html2PdfModel();

        $this->assertEquals(true, $model->terminate());
        $this->assertStringEndsWith('.pdf', $model->getFilename());
        $this->assertEquals('I', $model->getDest());
    }

    public function testGettersMustReturnTheAttributeValue()
    {
        $this->assertAttributeEquals($this->model->getFilename(), 'filename', $this->model);
        $this->assertAttributeEquals($this->model->getDest(), 'dest', $this->model);
    }
    
}