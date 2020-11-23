<?php

namespace App\Request;

use App\Entity\User;
use App\Entity\UserTaskState;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\AccessType("public_method")
 */
class UpdateUserTaskRequest implements UpdateRequestInterface
{
    /**
     * @Assert\Type("string")
     *
     * @var string|null
     */
    private ?string $description = null;

    /**
     * @Assert\Type(UserTaskState::class)
     *
     * @var UserTaskState|null
     */
    private ?UserTaskState $state = null;

    /**
     * @return bool
     */
    public function isDirty(): bool
    {
        if ($this->description || $this->state) {
            return true;
        }

        return false;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     */
    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return UserTaskState|null
     */
    public function getState(): ?UserTaskState
    {
        return $this->state;
    }

    /**
     * @param UserTaskState|null $state
     */
    public function setState(?UserTaskState $state): void
    {
        $this->state = $state;
    }
}