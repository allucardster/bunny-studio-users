<?php

namespace App\Service;

use App\Entity\User;
use App\Pagination\PaginationQuery;
use App\Pagination\PaginationResult;
use App\Repository\UserRepository;
use App\Request\CreateUserRequest;
use App\Request\UpdateUserRequest;
use Doctrine\ORM\EntityManagerInterface;

class UserService
{
    private UserRepository $repository;

    private EntityManagerInterface $entityManager;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(UserRepository $repository, EntityManagerInterface $entityManager)
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
     * @param CreateUserRequest $request
     * @return User
     */
    public function create(CreateUserRequest $request): User
    {
        $user = new User();
        $user->setName($request->getName());

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
    }

    /**
     * @param User $user
     * @param UpdateUserRequest $request
     * @return User
     */
    public function update(User $user, UpdateUserRequest $request): User
    {
        if ($request->getName() !== null) {
            $user->setName($request->getName());
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        }

        return $user;
    }

    /**
     * @param User $user
     */
    public function delete(User $user): void
    {
        $this->entityManager->remove($user);
        $this->entityManager->flush();
    }
}