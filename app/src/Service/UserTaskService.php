<?php

namespace App\Service;

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
     * @param PaginationQuery $paginationQuery
     * @return PaginationResult
     */
    public function list(PaginationQuery $paginationQuery): PaginationResult
    {
        return PaginationResult::createFrom($this->repository, $paginationQuery);
    }

    /**
     * @param CreateUserTaskRequest $request
     * @return UserTask
     */
    public function create(CreateUserTaskRequest $request): UserTask
    {
        $userTask = new UserTask();
        $userTask->setUser($request->getUser());
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
        if ($request->getUser() !== null) {
            $userTask->setUser();
        }

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