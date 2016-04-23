<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf\Mvc\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zff\Html2Pdf\Html2PdfFactory;
use Zff\Html2Pdf\View\Strategy\Html2PdfStrategy;
use Zff\Html2Pdf\View\Renderer\Html2PdfRenderer;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use HTML2PDF as Html2Pdf;

/**
 * Creates and returns the Html2Pdf view strategy
 */
class ViewHtml2PdfStrategyFactory implements FactoryInterface
{

    /**
     * Create and return the Html2Pdf view strategy
     *
     * Retrieves the ViewHtml2PdfRenderer service from the service locator, and
     * injects it into the constructor for the Html2Pdf strategy.
     *
     * It then attaches the strategy to the View service, at a priority of 100.
     *
     * @param  ServiceLocatorInterface $serviceLocator
     * @return Html2PdfStrategy
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $cName = null, $rName = null)
    {
        return $this($serviceLocator, $rName);
    }

    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string             $requestedName
     * @param  null|array         $options
     * @return Html2PdfStrategy
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get('Config');

        $html2pdfOptions = isset($config['zff-html2pdf']['options']) ? $config['zff-html2pdf']['options'] : [];

        $html2pdfRenderer = new Html2PdfRenderer();
        $html2pdfRenderer->setViewRenderer($container->get('ViewRenderer'));
        $html2pdfRenderer->setDefaultHtml2pdfOptions($html2pdfOptions);

        $html2pdfStrategy = new Html2PdfStrategy($html2pdfRenderer);

        return $html2pdfStrategy;
    }
}
