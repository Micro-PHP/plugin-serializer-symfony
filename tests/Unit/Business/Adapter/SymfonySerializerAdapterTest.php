<?php

declare(strict_types=1);

namespace Micro\Plugin\Serializer\Symfony\Test\Unit\Business\Adapter;

use Micro\Plugin\Serializer\Business\Context\SerializerContextInterface;
use Micro\Plugin\Serializer\Exception\SerializeException;
use Micro\Plugin\Serializer\Symfony\Business\Adapter\SymfonySerializerAdapter;
use Micro\Plugin\Serializer\Symfony\Context\SymfonySerializerContext;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Serializer\SerializerInterface;

class SymfonySerializerAdapterTest extends TestCase
{
    private $symfonySerializerMock;

    protected function setUp(): void
    {
        $this->symfonySerializerMock = $this->getMockBuilder(SerializerInterface::class)
            ->disableOriginalConstructor()
            ->getMockForAbstractClass();
    }

    public function testSerialize(): void
    {
        $serializer = new SymfonySerializerAdapter($this->symfonySerializerMock);

        $this->symfonySerializerMock->expects($this->once())
            ->method('serialize')
            ->with('data', 'json', [])
            ->willReturn('{serialized data}');

        $this->assertEquals('{serialized data}', $serializer->serialize('data', new SymfonySerializerContext(null, null, [])));
    }

    public function testSerializeException(): void
    {
        $serializer = new SymfonySerializerAdapter($this->symfonySerializerMock);

        $this->symfonySerializerMock->expects($this->never())
            ->method('serialize');

        $this->expectException(SerializeException::class);

        $serializer->serialize('data', $this->getMockForAbstractClass(SerializerContextInterface::class));
    }

    public function testDeserialize()
    {
        $serializer = new SymfonySerializerAdapter($this->symfonySerializerMock);

        $this->symfonySerializerMock->expects($this->once())
            ->method('deserialize')
            ->with('data', 'stdClass', 'json', [])
            ->willReturn('{deserialized data}');

        $this->assertEquals('{deserialized data}', $serializer->deserialize('data', new SymfonySerializerContext(null, null, [])));
    }

    public function testDeserializeException(): void
    {
        $serializer = new SymfonySerializerAdapter($this->symfonySerializerMock);

        $this->symfonySerializerMock->expects($this->never())
            ->method('deserialize');

        $this->expectException(SerializeException::class);

        $serializer->deserialize('data', $this->getMockForAbstractClass(SerializerContextInterface::class));
    }

    public function testSupports(): void
    {
        $serializer = new SymfonySerializerAdapter($this->symfonySerializerMock);

        $this->assertTrue($serializer->supports(
            $this->getMockBuilder(SymfonySerializerContext::class)
                ->disableOriginalConstructor()
                ->getMock()
        ));
        $this->assertFalse($serializer->supports(
            $this->getMockForAbstractClass(SerializerContextInterface::class))
        );
    }
}
