<?php
/**
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 * @license http://opensource.org/licenses/MIT MIT
 */

namespace ZffTest\Html2Pdf;

use PHPUnit_Framework_TestCase as TestCase;
use Zff\Html2Pdf\Module;

/**
 * @author Vinicius Fagundes <mvlacerda@gmail.com>
 */
class ModuleTest extends TestCase
{

    /**
     * @var Module
     */
    protected $module;

    public function setUp()
    {
        $this->module = new Module;
    }

    public function testConfig()
    {
        $this->assertNotEmpty($this->module->getConfig());

        $configArr = include __DIR__.'/../config/module.config.php';

        $this->assertEquals($configArr, $this->module->getConfig());
    }

    public function testAutoloader()
    {
        $this->assertNotEmpty($this->module->getAutoloaderConfig());
    }
}
