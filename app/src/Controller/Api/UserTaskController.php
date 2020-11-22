<?php

namespace App\Controller\Api;

use App\Entity\UserTask;
use App\Pagination\PaginationQuery;
use App\Pagination\PaginationResult;
use App\Request\CreateUserTaskRequest;
use App\Request\UpdateUserTaskRequest;
use App\Service\UserTaskService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\View\View;
use JMS\Serializer\Exception\ValidationFailedException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration as Sensio;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Validator\ConstraintViolationListInterface;

/**
 * @Rest\Route("/user-task")
 */
class UserTaskController
{
    /**
     * @Rest\Get("/list")
     * @Rest\View()
     *
     * @param PaginationQuery $paginationQuery
     * @param UserTaskService $userTaskService
     * @return PaginationResult
     */
    public function list(PaginationQuery $paginationQuery, UserTaskService $userTaskService): PaginationResult
    {
        return $userTaskService->list($paginationQuery);
    }

    /**
     * @Rest\Post("")
     *
     * @Sensio\ParamConverter("request", converter="fos_rest.request_body")
     *
     * @param CreateUserTaskRequest $request
     * @param ConstraintViolationListInterface $constraintViolationList
     * @param UserTaskService $userTaskService
     * @return View
     */
    public function create(
        CreateUserTaskRequest $request,
        ConstraintViolationListInterface $constraintViolationList,
        UserTaskService $userTaskService
    ): View {
        if ($constraintViolationList->count() > 0) {
            return View::create($constraintViolationList, Response::HTTP_BAD_REQUEST);
        }

        return View::create($userTaskService->create($request), Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/{id}")
     * @Rest\View()
     *
     * @param UserTask $user
     * @return UserTask
     */
    public function read(UserTask $user): UserTask
    {
        return $user;
    }

    /**
     * @Rest\Patch("/{id}")
     *
     * @Sensio\ParamConverter("request", converter="fos_rest.request_body")
     *
     * @param UserTask $userTask
     * @param UpdateUserTaskRequest $request
     * @param ConstraintViolationListInterface $constraintViolationList
     * @param UserTaskService $userTaskService
     * @return View
     */
    public function update(
        UserTask $userTask,
        UpdateUserTaskRequest $request,
        ConstraintViolationListInterface $constraintViolationList,
        UserTaskService $userTaskService
    ): View {
        if ($constraintViolationList->count() > 0) {
            return View::create($constraintViolationList, Response::HTTP_BAD_REQUEST);
        }

        $userTaskService->update($userTask, $request);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Delete("/{id}")
     *
     * @param UserTask $userTask
     * @param UserTaskService $userTaskService
     * @return View
     */
    public function delete(UserTask $userTask, UserTaskService $userTaskService): View
    {
        $userTaskService->delete($userTask);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}