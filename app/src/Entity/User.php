<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Ramsey\Uuid\UuidInterface;

/**
 * @ORM\Table(name="bsu_user")
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @Serializer\AccessType("public_method")
 */
class User
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
     * @ORM\Column(type="string", length=255)
     *
     * @var string
     */
    private string $name;

    /**
     * @ORM\OneToMany(targetEntity="UserTask", mappedBy="user", cascade={"persist", "remove"}, orphanRemoval=true)
     * @Serializer\Groups({"details"})
     *
     * @var Collection
     */
    private Collection $tasks;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->tasks = new ArrayCollection();
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return Collection
     */
    public function getTasks(): Collection
    {
        return $this->tasks;
    }

    /**
     * @param Collection $tasks
     */
    public function setTasks(Collection $tasks): void
    {
        $this->tasks = $tasks;
    }

    /**
     * @param UserTask $task
     */
    public function addTask(UserTask $task): void
    {
        $this->tasks->add($task);
    }

    /**
     * @param UserTask $task
     */
    public function removeTask(UserTask $task): void
    {
        $this->tasks->remove($task);
    }
}