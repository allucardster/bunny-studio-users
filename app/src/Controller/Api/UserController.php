<?php

namespace App\Controller\Api;

use App\Pagination\PaginationQuery;
use App\Pagination\PaginationResult;
use App\Service\UserService;
use FOS\RestBundle\Controller\Annotations as Rest;

/**
 * @Rest\Route("/user")
 */
class UserController
{
    /**
     * @Rest\Get("/list")
     * @Rest\View()
     *
     * @param PaginationQuery $paginationQuery
     * @param UserService $userService
     * @return PaginationResult
     */
    public function list(PaginationQuery $paginationQuery, UserService $userService): PaginationResult
    {
        return $userService->list($paginationQuery);
    }
}