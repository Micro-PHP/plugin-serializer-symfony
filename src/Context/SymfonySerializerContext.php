<?php

declare(strict_types=1);

namespace Micro\Plugin\Serializer\Symfony\Context;

use Micro\Plugin\Serializer\Business\Context\SerializerContextInterface;

/**
 * @codeCoverageIgnore
 */
class SymfonySerializerContext implements SerializerContextInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function __construct(
        private ?string $sourceFormat,
        private ?string $destinationFormat,
        private array $context = []
    ) {
    }

    public function getSourceFormat(): ?string
    {
        return $this->sourceFormat;
    }

    public function getDestinationFormat(): ?string
    {
        return $this->destinationFormat;
    }

    /**
     * {@inheritdoc}
     */
    public function getContext(): array
    {
        return $this->context;
    }
}
