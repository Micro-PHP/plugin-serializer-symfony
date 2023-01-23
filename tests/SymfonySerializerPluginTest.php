<?php

declare(strict_types=1);

namespace Micro\Plugin\Serializer\Symfony\Test;

use Micro\Kernel\App\AppKernel;
use Micro\Plugin\Serializer\Plugin\SerializerAdapterPluginInterface;
use Micro\Plugin\Serializer\SerializerPlugin;
use Micro\Plugin\Serializer\Symfony\SymfonySerializerPlugin;
use PHPUnit\Framework\TestCase;

class SymfonySerializerPluginTest extends TestCase
{
    public function testProvideSerializerFactory(): void
    {
        $kernel = new AppKernel([], [
            SerializerPlugin::class,
            SymfonySerializerPlugin::class,
        ]);

        $kernel->run();

        $plugins = iterator_to_array($kernel->plugins(SerializerAdapterPluginInterface::class));
        $plugin = array_shift($plugins);
        $this->assertInstanceOf(SerializerAdapterPluginInterface::class, $plugin);
        $this->assertInstanceOf(SymfonySerializerPlugin::class, $plugin);
    }
}
