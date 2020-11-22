<?php

namespace App\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\AccessType("public_method")
 */
class UpdateUserRequest implements UpdateRequestInterface
{
    /**
     * @Assert\NotBlank(allowNull=true)
     *
     * @var string|null
     */
    private ?string $name = null;

    /**
     * @return bool
     */
    public function isDirty(): bool
    {
        if ($this->getName()) {
            return true;
        }

        return false;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }
}