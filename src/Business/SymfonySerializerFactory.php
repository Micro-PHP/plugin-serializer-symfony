<?php

namespace Micro\Plugin\Serializer\Adapter\Symfony\Business;

use Micro\Plugin\Serializer\Business\SerializerFactoryInterface;
use Micro\Plugin\Serializer\Business\SerializerInterface;
use Symfony\Component\Serializer\Encoder\EncoderInterface;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class SymfonySerializerFactory implements SerializerFactoryInterface
{
    /**
     * @return SerializerInterface
     */
    public function create(): SerializerInterface
    {
        return new SymfonySerializerDecorator($this->createSymfonySerializer());
    }

    /**
     * @return EncoderInterface[]
     */
    protected function createEncoders(): array
    {
        return [
            new XmlEncoder(),
            new JsonEncoder(),
        ];
    }

    /**
     * @return NormalizerInterface[]
     */
    protected function createNormalizers(): array
    {
        return [
            new ObjectNormalizer(),
        ];
    }

    /**
     * @return SymfonySerializerInterface
     */
    protected function createSymfonySerializer(): SymfonySerializerInterface
    {
        return new SymfonySerializer(
            $this->createNormalizers(),
            $this->createEncoders()
        );
    }
}
