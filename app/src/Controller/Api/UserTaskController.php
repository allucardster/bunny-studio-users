<?php

namespace App\Controller\Api;

use App\Entity\User;
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
 * @Rest\Route("/user/{user_id}/user-task")
 */
class UserTaskController
{
    /**
     * @Rest\Get("/list")
     * @Rest\View()
     *
     * @Sensio\ParamConverter("user", options={"id" = "user_id"})
     *
     * @param User $user
     * @param PaginationQuery $paginationQuery
     * @param UserTaskService $userTaskService
     * @return PaginationResult
     */
    public function list(User $user, PaginationQuery $paginationQuery, UserTaskService $userTaskService): PaginationResult
    {
        return $userTaskService->list($user, $paginationQuery);
    }

    /**
     * @Rest\Post("")
     *
     * @Sensio\ParamConverter("user", options={"id" = "user_id"})
     * @Sensio\ParamConverter("request", converter="fos_rest.request_body")
     *
     * @param User $user
     * @param CreateUserTaskRequest $request
     * @param ConstraintViolationListInterface $constraintViolationList
     * @param UserTaskService $userTaskService
     * @return View
     */
    public function create(
        User $user,
        CreateUserTaskRequest $request,
        ConstraintViolationListInterface $constraintViolationList,
        UserTaskService $userTaskService
    ): View {
        if ($constraintViolationList->count() > 0) {
            return View::create($constraintViolationList, Response::HTTP_BAD_REQUEST);
        }

        return View::create($userTaskService->create($user, $request), Response::HTTP_CREATED);
    }

    /**
     * @Rest\Get("/{id}")
     *
     * @Sensio\ParamConverter("user", options={"id" = "user_id"})
     *
     * @param User $user
     * @param UserTask $userTask
     * @return View
     */
    public function read(User $user, UserTask $userTask): View
    {
        if (!$userTask->getUser()->getId()->equals($user->getId())) {
            return View::create(
                ['error' => 'The given user id doesn\'t corresponds with user task user.'],
                Response::HTTP_BAD_REQUEST
            );
        }

        return View::create($userTask, Response::HTTP_OK);
    }

    /**
     * @Rest\Patch("/{id}")
     *
     * @Sensio\ParamConverter("user", options={"id" = "user_id"})
     * @Sensio\ParamConverter("request", converter="fos_rest.request_body")
     *
     * @param User $user
     * @param UserTask $userTask
     * @param UpdateUserTaskRequest $request
     * @param ConstraintViolationListInterface $constraintViolationList
     * @param UserTaskService $userTaskService
     * @return View
     */
    public function update(
        User $user,
        UserTask $userTask,
        UpdateUserTaskRequest $request,
        ConstraintViolationListInterface $constraintViolationList,
        UserTaskService $userTaskService
    ): View {
        if ($constraintViolationList->count() > 0) {
            return View::create($constraintViolationList, Response::HTTP_BAD_REQUEST);
        }

        if (!$userTask->getUser()->getId()->equals($user->getId())) {
            return View::create(
                ['error' => 'The given user id doesn\'t corresponds with user task user.'],
                Response::HTTP_BAD_REQUEST
            );
        }

        $userTaskService->update($userTask, $request);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * @Rest\Delete("/{id}")
     *
     * @Sensio\ParamConverter("user", options={"id" = "user_id"})
     *
     * @param User $user
     * @param UserTask $userTask
     * @param UserTaskService $userTaskService
     * @return View
     */
    public function delete(User $user, UserTask $userTask, UserTaskService $userTaskService): View
    {
        if (!$userTask->getUser()->getId()->equals($user->getId())) {
            return View::create(
                ['error' => 'The given user id doesn\'t corresponds with user task user.'],
                Response::HTTP_BAD_REQUEST
            );
        }

        $userTaskService->delete($userTask);

        return View::create(null, Response::HTTP_NO_CONTENT);
    }
}