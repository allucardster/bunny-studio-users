<?php

namespace App\Entity;

use App\Repository\UserTaskRepository;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="bsu_user_task")
 * @ORM\Entity(repositoryClass=UserTaskRepository::class)
 * @Serializer\AccessType("public_method")
 */
class UserTask
{
    /**
     * @ORM\Id
     * @ORM\Column(type="uuid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     * @Serializer\Type("string")
     * @Serializer\ReadOnly()
     *
     * @var UuidInterface
     */
    private UuidInterface $id;

    /**
     * @ORM\Column(type="text")
     *
     * @var string
     */
    private string $description;

    /**
     * @ORM\Column(type=UserTaskState::class, length=20)
     *
     * @var UserTaskState
     */
    private UserTaskState $state;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="tasks")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     *
     * @var User
     */
    private User $user;

    /**
     * @return UuidInterface
     */
    public function getId(): UuidInterface
    {
        return $this->id;
    }

    /**
     * @param UuidInterface $id
     */
    public function setId(UuidInterface $id): void
    {
        $this->id = $id;
    }

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

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void
    {
        $this->user = $user;
    }
}