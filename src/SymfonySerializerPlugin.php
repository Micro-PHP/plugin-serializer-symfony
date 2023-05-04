<?php

namespace Micro\Plugin\Serializer\Symfony;

use Micro\Plugin\Serializer\Plugin\SerializerAdapterPluginInterface;
use Micro\Plugin\Serializer\Plugin\SerializerInterface;
use Micro\Plugin\Serializer\Symfony\Business\Adapter\SymfonySerializerAdapter;
use Symfony\Component\Serializer\Encoder\DecoderInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonDecode;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class SymfonySerializerPlugin implements SerializerAdapterPluginInterface
{
    public function createSerializer(): SerializerInterface
    {
        return new SymfonySerializerAdapter(
            $this->createSymfonySerializer()
        );
    }

    protected function createSymfonySerializer(): Serializer
    {
        return new Serializer(
            $this->createNormalizers(),
            $this->createEncoders()
        );
    }

    /**
     * @return NormalizerInterface[]|DenormalizerInterface[]
     */
    protected function createNormalizers(): array
    {
        return [
            new ObjectNormalizer(),
        ];
    }

    /**
     * @return EncoderInterface[]|DecoderInterface[]
     */
    protected function createEncoders(): array
    {
        return [
            new JsonEncoder(),
            new JsonDecode(),
        ];
    }
}
