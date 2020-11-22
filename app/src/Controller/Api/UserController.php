<?php

namespace App\Controller\Api;

use App\Entity\User;
use App\Pagination\PaginationQuery;
use App\Pagination\PaginationResult;
use App\Request\CreateUserRequest;
use App\Request\UpdateUserRequest;
use App\Service\UserService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\Exception\ValidationFailedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

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

    /**
     * @Rest\Post("")
     *
     * @Sensio\ParamConverter("request", converter="fos_rest.request_body")
     *
     * @param CreateUserRequest $request
     * @param ConstraintViolationListInterface $constraintViolationList
     * @param UserService $userService
     * @return View
     */
    public function create(CreateUserRequest $request, ConstraintViolationListInterface $constraintViolationList, UserService $userService): View
    {
        if ($constraintViolationList->count() > 0) {
            return View::create($constraintViolationList, Response::HTTP_BAD_REQUEST);
        }

        return View::create($userService->create($request), Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/{id}")
     * @Rest\View()
     *
     * @param User $user
     * @return User
     */
    public function read(User $user): User
    {
        return $user;
    }

    /**
     * @Rest\Patch("/{id}")
     *
     * @Sensio\ParamConverter("request", converter="fos_rest.request_body")
     *
     * @param User $user
     * @param UpdateUserRequest $request
     * @param ConstraintViolationListInterface $constraintViolationList
     * @param UserService $userService
     * @return View
     */
    public function update(User $user, UpdateUserRequest $request, ConstraintViolationListInterface $constraintViolationList, UserService $userService): View
    {
        if ($constraintViolationList->count() > 0) {
            return View::create($constraintViolationList, Response::HTTP_BAD_REQUEST);
        }

        $userService->update($user, $request);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Delete("/{id}")
     *
     * @param User $user
     * @param UserService $userService
     * @return View
     */
    public function delete(User $user, UserService $userService): View
    {
        $userService->delete($user);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}