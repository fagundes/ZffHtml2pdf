<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace ZffTest\Html2Pdf\Mvc\Service;

use PHPUnit_Framework_TestCase as TestCase;
use Zff\Html2Pdf\Mvc\Service\ViewHtml2PdfStrategyFactory;
use Zend\ServiceManager\ServiceManager;
use Zend\Mvc\Service\ServiceManagerConfig;
use Zend\Mvc\Application;

class ViewHtml2PdfStrategyFactoryTest extends TestCase
{
    /**
     * @var ServiceManager 
     */
    protected $serviceManager;

    public function setUp()
    {
        $config = ['modules' => ['Zff\\Html2Pdf'], 'module_listener_options' => []];

        $serviceManager = new ServiceManager(new ServiceManagerConfig());
        $serviceManager->setService('ApplicationConfig', $config);
        $serviceManager->get('ModuleManager')->loadModules();

        $application = new Application($config, $serviceManager);
        $application->bootstrap();

        $this->serviceManager = $serviceManager;
    }

    public function testCanCreateHtml2PdfStrategyFromNewFactoryInstance()
    {
        $factory = new ViewHtml2PdfStrategyFactory;
        $this->assertInstanceOf('\Zff\Html2Pdf\View\Strategy\Html2PdfStrategy', $factory->createService($this->serviceManager));
    }

    public function testCanCreateHtml2PdfStrategyFromServiceManager()
    {
        $this->assertInstanceOf('\Zff\Html2Pdf\View\Strategy\Html2PdfStrategy', $this->serviceManager->get('ViewHtml2PdfStrategy'));
    }
}