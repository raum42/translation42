<?php

/*
 * translation42
 *
 * @package translation42
 * @link https://github.com/kiwi-suite/translation42
 * @copyright Copyright (c) 2010 - 2017 kiwi suite (https://www.kiwi-suite.com)
 * @license MIT License
 * @author kiwi suite <dev@kiwi-suite.com>
 */

namespace Translation42\I18n\Translator\Service;

use Interop\Container\ContainerInterface;
use Interop\Container\Exception\ContainerException;
use Translation42\I18n\Translator\DatabaseTranslationLoader;
use Translation42\TableGateway\TranslationTableGateway;
use Zend\ServiceManager\Exception\ServiceNotCreatedException;
use Zend\ServiceManager\Exception\ServiceNotFoundException;
use Zend\ServiceManager\Factory\FactoryInterface;

class DatabaseTranslationLoaderFactory implements FactoryInterface
{
    /**
     * Create an object
     *
     * @param  ContainerInterface $container
     * @param  string $requestedName
     * @param  null|array $options
     * @return object
     * @throws ServiceNotFoundException if unable to resolve the service.
     * @throws ServiceNotCreatedException if an exception is raised when
     *     creating a service.
     * @throws ContainerException if any other error occurs
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DatabaseTranslationLoader(
            $container->get('TableGateway')->get(TranslationTableGateway::class)
        );
    }
}
