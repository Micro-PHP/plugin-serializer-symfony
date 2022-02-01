<?php

namespace Micro\Plugin\Serializer\Adapter\Symfony\Business;

use Micro\Plugin\Serializer\Business\SerializerInterface;
use Micro\Plugin\Serializer\SerializerFacadeInterface;
use Symfony\Component\Serializer\SerializerInterface as SymfonySerializerInterface;

class SymfonySerializerDecorator implements SerializerInterface
{

    private const FORMAT_COLL = [
        SerializerFacadeInterface::FORMAT_JSON => 'json',
        SerializerFacadeInterface::FORMAT_XML   => 'xml',
    ];

    public function __construct(private SymfonySerializerInterface $serializer)
    {
    }

    /**
     * @param  mixed $object
     * @param  string $format
     * @param  array  $context
     * @return string
     */
    public function serialize(mixed $object, string $format, array $context = []): string
    {
        return $this->serializer->serialize($object, self::FORMAT_COLL[$format], $context);
    }

    /**
     * @param  string $data
     * @param  string $objectClass
     * @param  string $format
     * @param  array  $options
     * @return object
     */
    public function deserialize(string $data, string $objectClass, string $format, array $options = []): mixed
    {
        return $this->serializer->deserialize($data, $objectClass, $format, $options);
    }
}
