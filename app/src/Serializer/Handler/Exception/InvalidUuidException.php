<?php

namespace App\Serializer\Handler\Exception;

use Exception;
use Throwable;

class InvalidUuidException extends Exception
{
    private string $invalidUuid;

    public function __construct(string $invalidUuid, ?Throwable $exception = null)
    {
        parent::__construct(
            sprintf('"%s" is not a valid UUID', $invalidUuid),
            0,
            $exception
        );
        $this->invalidUuid = $invalidUuid;
    }

    public function getInvalidUuid(): string
    {
        return $this->invalidUuid;
    }
}