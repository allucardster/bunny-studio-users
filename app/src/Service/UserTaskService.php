<?php

namespace App\Service;

use App\Pagination\PaginationQuery;
use App\Pagination\PaginationResult;
use App\Repository\UserTaskRepository;

class UserTaskService
{
    private UserTaskRepository $repository;

    /**
     * UserTaskService constructor.
     * @param UserTaskRepository $repository
     */
    public function __construct(UserTaskRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param PaginationQuery $paginationQuery
     * @return PaginationResult
     */
    public function list(PaginationQuery $paginationQuery): PaginationResult
    {
        return PaginationResult::createFrom($this->repository, $paginationQuery);
    }

}