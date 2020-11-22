<?php

namespace App\Request;

use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\AccessType("public_method")
 */
class UpdateUserRequest
{
    /**
     * @Assert\NotBlank(allowNull=true)
     *
     * @var string|null
     */
    private ?string $name = null;

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