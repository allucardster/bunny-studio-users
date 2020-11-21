<?php

namespace App\Pagination;

use App\Entity\UserTask;

class UserTaskPaginationResult extends AbstractPaginationResult
{
    /**
     * UserTaskPaginationResult constructor.
     * @param UserTask[] $results
     * @param int $total
     * @param int $perPage
     * @param int $page
     */
    public function __construct(array $results, int $total, int $perPage, int $page)
    {
        parent::__construct($results, $total, $perPage, $page);
    }

    /**
     * @return UserTask[]
     */
    public function getResults(): array
    {
        return parent::getResults();
    }

    /**
     * @param UserTask[] $results
     */
    public function setResults(array $results): void
    {
        parent::setResults($results);
    }
}