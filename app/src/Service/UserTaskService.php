<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\UserTask;
use App\Pagination\PaginationQuery;
use App\Pagination\PaginationResult;
use App\Repository\UserTaskRepository;
use App\Request\CreateUserTaskRequest;
use App\Request\UpdateUserTaskRequest;
use Doctrine\ORM\EntityManagerInterface;

class UserTaskService
{
    private UserTaskRepository $repository;

    private EntityManagerInterface $entityManager;

    /**
     * UserTaskService constructor.
     * @param UserTaskRepository $repository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserTaskRepository $repository, EntityManagerInterface $entityManager)
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
    }

    /**
     * @param User $user
     * @param PaginationQuery $paginationQuery
     * @return PaginationResult
     */
    public function list(User $user, PaginationQuery $paginationQuery): PaginationResult
    {
        return PaginationResult::createFrom($this->repository, $paginationQuery, ['user' => $user]);
    }

    /**
     * @param User $user
     * @param CreateUserTaskRequest $request
     * @return UserTask
     */
    public function create(User $user, CreateUserTaskRequest $request): UserTask
    {
        $userTask = new UserTask();
        $userTask->setUser($user);
        $userTask->setDescription($request->getDescription());
        $userTask->setState($request->getState());

        $this->entityManager->persist($userTask);
        $this->entityManager->flush();

        return $userTask;
    }

    /**
     * @param UserTask $userTask
     * @param UpdateUserTaskRequest $request
     * @return UserTask
     */
    public function update(UserTask $userTask, UpdateUserTaskRequest $request): UserTask
    {
        if ($request->getDescription() !== null) {
            $userTask->setDescription($userTask->getDescription());
        }

        if ($request->getState() !== null) {
            $userTask->setState($request->getState());
        }

        if ($request->isDirty()) {
            $this->entityManager->persist($userTask);
            $this->entityManager->flush();
        }

        return $userTask;
    }

    /**
     * @param UserTask $userTask
     */
    public function delete(UserTask $userTask): void
    {
        $this->entityManager->remove($userTask);
        $this->entityManager->flush();
    }

}