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
     * @Assert\Type(User::class)
     *
     * @var User|null
     */
    private ?User $user = null;

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
        if ($this->user || $this->description || $this->state) {
            return true;
        }

        return false;
    }

    /**
     * @return User|null
     */
    public function getUser(): ?User
    {
        return $this->user;
    }

    /**
     * @param User|null $user
     */
    public function setUser(?User $user): void
    {
        $this->user = $user;
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