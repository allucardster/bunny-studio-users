<?php

namespace App\Serializer\Handler;

use App\Serializer\Handler\Exception\DeserializationInvalidValueException;
use App\Serializer\Handler\Exception\InvalidUuidException;
use JMS\Serializer\Context;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Metadata\PropertyMetadata;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

class UuidSerializerHandler implements SubscribingHandlerInterface
{
    private const PATH_FIELD_SEPARATOR = '.';
    private const TYPE_UUID = 'uuid';

    public static function getSubscribingMethods(): array
    {
        $formats = [
            'json',
            'xml',
            'yml',
        ];
        $methods = [];
        foreach ($formats as $format) {
            $methods[] = [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'type' => self::TYPE_UUID,
                'format' => $format,
                'method' => 'serializeUuid',
            ];
            $methods[] = [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'type' => self::TYPE_UUID,
                'format' => $format,
                'method' => 'deserializeUuid',
            ];
        }

        return $methods;
    }

    /**
     * @param DeserializationVisitorInterface $visitor
     * @param mixed $data
     * @param mixed[] $type
     * @param Context $context
     * @return UuidInterface
     * @throws DeserializationInvalidValueException
     */
    public function deserializeUuid(DeserializationVisitorInterface $visitor, $data, array $type, Context $context): UuidInterface
    {
        try {
            return $this->deserializeUuidValue((string) $data);
        } catch (InvalidUuidException $e) {
            throw new DeserializationInvalidValueException(
                $this->getFieldPath($context),
                $e
            );
        }
    }

    /**
     * @param string $uuidString
     * @return UuidInterface
     * @throws InvalidUuidException
     */
    private function deserializeUuidValue(string $uuidString): UuidInterface
    {
        if (!Uuid::isValid($uuidString)) {
            throw new InvalidUuidException($uuidString);
        }
        return Uuid::fromString($uuidString);
    }

    /**
     * @param SerializationVisitorInterface $visitor
     * @param UuidInterface $uuid
     * @param mixed[] $type
     * @return string|object
     */
    public function serializeUuid(SerializationVisitorInterface $visitor, UuidInterface $uuid, array $type)
    {
        return $visitor->visitString($uuid->toString(), $type);
    }

    private function getFieldPath(Context $context): string
    {
        $path = '';
        foreach ($context->getMetadataStack() as $element) {
            if ($element instanceof PropertyMetadata) {
                $name = ($element->serializedName !== null) ? $element->serializedName : $element->name;

                $path = $name . self::PATH_FIELD_SEPARATOR . $path;
            }
        }
        $path = rtrim($path, self::PATH_FIELD_SEPARATOR);

        return $path;
    }
}