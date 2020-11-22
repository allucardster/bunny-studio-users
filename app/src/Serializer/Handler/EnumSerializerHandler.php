<?php

namespace App\Serializer\Handler;

use JMS\Serializer\Context;
use JMS\Serializer\Exception\RuntimeException;
use JMS\Serializer\GraphNavigatorInterface;
use JMS\Serializer\Handler\SubscribingHandlerInterface;
use JMS\Serializer\Visitor\DeserializationVisitorInterface;
use JMS\Serializer\Visitor\SerializationVisitorInterface;
use MyCLabs\Enum\Enum;

class EnumSerializerHandler implements SubscribingHandlerInterface
{
    public static function getSubscribingMethods()
    {
        return [
            [
                'direction' => GraphNavigatorInterface::DIRECTION_SERIALIZATION,
                'format' => 'json',
                'type' => Enum::class,
                'method' => 'serializeEnumToJson',
            ],
            [
                'direction' => GraphNavigatorInterface::DIRECTION_DESERIALIZATION,
                'format' => 'json',
                'type' => Enum::class,
                'method' => 'deserializeEnumToJson',
            ],
        ];
    }

    /**
     * @param SerializationVisitorInterface $visitor
     * @param Enum $enum
     * @param array $type
     * @param Context $context
     * @return mixed
     */
    public function serializeEnumToJson(
        SerializationVisitorInterface $visitor,
        Enum $enum,
        array $type,
        Context $context
    ) {
        return $enum->getValue();
    }

    /**
     * @param DeserializationVisitorInterface $visitor
     * @param $enumValue
     * @param array $type
     * @param Context $context
     * @return mixed
     */
    public function deserializeEnumToJson(
        DeserializationVisitorInterface $visitor,
        $enumValue,
        array $type,
        Context $context
    ) {
        $className = $type['name'];

        if (!is_subclass_of($className, Enum::class)) {
            throw new RuntimeException(sprintf('Invalid type: %s.', $className));
        }

        if (!$className::isValid($enumValue)) {
            throw new RuntimeException(
                sprintf(
                    'Invalid enum [%s] value: %s. Expected values: [%s]',
                    $className,
                    $enumValue,
                    implode(', ', $className::values())
                )
            );
        }

        return new $className($enumValue);
    }
}