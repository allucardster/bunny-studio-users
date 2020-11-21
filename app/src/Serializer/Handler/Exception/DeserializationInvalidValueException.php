<?php

namespace App\Serializer\Handler\Exception;

use Exception;
use Throwable;

class DeserializationInvalidValueException extends Exception
{
    private string $fieldPath;

    public function __construct(string $fieldPath, Throwable $exception)
    {
        parent::__construct(
            sprintf('Invalid value in field %s: %s', $fieldPath, $exception->getMessage()),
            0,
            $exception
        );
        $this->fieldPath = $fieldPath;
    }

    public function getFieldPath(): string
    {
        return $this->fieldPath;
    }
}