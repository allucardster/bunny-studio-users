<?php

namespace App\Pagination;

use App\Entity\User;

class UserPaginationResult extends AbstractPaginationResult
{
    /**
     * UserPaginationResult constructor.
     * @param User[] $results
     * @param int $total
     * @param int $perPage
     * @param int $page
     */
    public function __construct(array $results, int $total, int $perPage, int $page)
    {
        parent::__construct($results, $total, $perPage, $page);
    }

    /**
     * @return User[]
     */
    public function getResults(): array
    {
        return parent::getResults();
    }

    /**
     * @param User[] $results
     */
    public function setResults(array $results): void
    {
        parent::setResults($results);
    }
}