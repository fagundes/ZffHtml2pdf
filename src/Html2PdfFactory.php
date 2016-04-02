<?php
/**
 * @license http://opensource.org/licenses/MIT MIT
 * @copyright Copyright (c) 2015 Vinicius Fagundes
 */

namespace Zff\Html2Pdf;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use HTML2PDF as Html2Pdf;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class Html2PdfFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return Html2Pdf
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $defaultOptions = [
            'orientation' => 'P',
            'format'      => 'A4',
            'lang'        => 'en',
            'unicode'     => true,
            'encoding'    => 'UTF-8',
            'margins'     => [0, 0, 0, 0],
        ];

        $options = array_merge($defaultOptions, $options);

        return new Html2Pdf(
            $options['orientation'],
            $options['format'],
            $options['lang'],
            $options['unicode'],
            $options['encoding'],
            $options['margins']
        );
    }

    /**
     * Create service
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return Html2Pdf
     */
    public function createService(ServiceLocatorInterface $serviceLocator, $cName = null, $rName = null)
    {
        return $this($serviceLocator, $rName);
    }
}