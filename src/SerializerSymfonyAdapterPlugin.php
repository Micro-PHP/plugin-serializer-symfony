<?php

namespace Micro\Plugin\Serializer\Adapter\Symfony;

use Micro\Component\DependencyInjection\Container;
use Micro\Framework\Kernel\Plugin\AbstractPlugin;
use Micro\Plugin\Serializer\Adapter\Symfony\Business\SymfonySerializerFactory;
use Micro\Plugin\Serializer\Business\SerializerFactoryInterface;
use Micro\Plugin\Serializer\Business\SerializerFactoryProviderFacade;

class SerializerSymfonyAdapterPlugin extends AbstractPlugin
{
    /**
     * {@inheritDoc}
     */
    public function provideDependencies(Container $container): void
    {
        $this->provideSerializerFactory($container);
    }

    /**
     * @param  Container $container
     * @return void
     */
    protected function provideSerializerFactory(Container $container): void
    {
        $container->register(
            SerializerFactoryInterface::class, function (Container $container) {
                return $this->createSerializerFactory();
            }
        );
    }

    /**
     * @return SerializerFactoryInterface
     */
    protected function createSerializerFactory(): SerializerFactoryInterface
    {
        return new SymfonySerializerFactory();
    }
}
