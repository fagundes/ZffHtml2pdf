<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace ZffTest\Html2Pdf;

use PHPUnit_Framework_TestCase as TestCase;

/**
 * @author Vinicius Fagundes <mvlacerda@gmail.com>
 */
class ModuleTest extends TestCase
{

    /**
     * Scans service manager configuration, returning all services created by factories and invokables
     * @return array
     */
    public function provideServiceList()
    {
        return [
            [
                'service' => 'ViewHtml2PdfStrategy',
                'class'   => '\Zff\Html2Pdf\View\Strategy\Html2PdfStrategy'
            ]
        ];
    }

    /**
     * @dataProvider provideServiceList
     */
    public function testService($service, $class)
    {
        $sm = Bootstrap::getServiceManager();

        // test if service is available in SM
        $this->assertTrue($sm->has($service));

        // test if correct instance is created
        $this->assertInstanceOf($class, $sm->get($service));
    }
}