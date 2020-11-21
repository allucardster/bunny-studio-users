<?php

namespace App\Service;

use App\Pagination\PaginationQuery;
use App\Pagination\PaginationResult;
use App\Repository\UserRepository;

class UserService
{
    private UserRepository $repository;

    /**
     * UserService constructor.
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
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