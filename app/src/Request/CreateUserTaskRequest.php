<?php

namespace App\Request;

use App\Entity\User;
use App\Entity\UserTaskState;
use JMS\Serializer\Annotation as Serializer;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @Serializer\AccessType("public_method")
 */
class CreateUserTaskRequest
{
    /**
     * @Assert\NotBlank()
     * @Assert\Type("string")
     *
     * @var string
     */
    private string $description;

    /**
     * @Assert\NotNull()
     * @Assert\Type(UserTaskState::class)
     *
     * @var UserTaskState
     */
    private UserTaskState $state;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return UserTaskState
     */
    public function getState(): UserTaskState
    {
        return $this->state;
    }

    /**
     * @param UserTaskState $state
     */
    public function setState(UserTaskState $state): void
    {
        $this->state = $state;
    }
}