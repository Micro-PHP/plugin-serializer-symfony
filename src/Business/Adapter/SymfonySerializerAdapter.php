<?php

namespace Micro\Plugin\Serializer\Symfony\Business;

use Micro\Plugin\Serializer\Business\Context\SerializerContextInterface;
use Micro\Plugin\Serializer\Exception\SerializeException;
use Micro\Plugin\Serializer\Plugin\SerializerInterface;
use Micro\Plugin\Serializer\Symfony\Context\SymfonySerializerContext;
use Symfony\Component\Serializer\Serializer as SymfonySerializer;

readonly class SymfonySerializerAdapter implements SerializerInterface
{
    public function __construct(private SymfonySerializer $serializer)
    {
    }

    public function serialize(mixed $data, SerializerContextInterface $context): string
    {
        if (!$context instanceof SymfonySerializerContext) {
            throw new SerializeException(sprintf('Symfony serializer plugin only supports %s.', SymfonySerializerContext::class));
        }

        return $this->serializer->serialize(
            $data,
            $context->getDestinationFormat(),
            $context->getContext()
        );
    }

    public function deserialize(mixed $data, SerializerContextInterface $context): mixed
    {
        if (!$context instanceof SymfonySerializerContext) {
            throw new SerializeException('Symfony serializer plugin only supports SymfonySerializerContext.');
        }

        return $this->serializer->deserialize(
            $data,
            $context->getDestinationFormat(),
            $context->getSourceFormat(),
            $context->getContext()
        );
    }

    public function supports(SerializerContextInterface $serializerContext): bool
    {
        return $serializerContext instanceof SymfonySerializerContext;
    }
}
