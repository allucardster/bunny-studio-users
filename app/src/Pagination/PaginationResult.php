<?php

namespace App\Pagination;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\AccessType("public_method")
 */
class PaginationResult
{
    /**
     * @var array
     */
    private array $results;

    /**
     * @var int
     */
    private int $total;

    /**
     * @var int
     */
    private int $perPage;

    /**
     * PaginationResult constructor.
     * @param array $results
     * @param int $total
     * @param int $perPage
     */
    public function __construct(array $results, int $total, int $perPage)
    {
        $this->results = $results;
        $this->total = $total;
        $this->perPage = $perPage;
    }

    /**
     * @return array
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param array $results
     */
    public function setResults(array $results): void
    {
        $this->results = $results;
    }

    /**
     * @return int
     */
    public function getTotal(): int
    {
        return $this->total;
    }

    /**
     * @param int $total
     */
    public function setTotal(int $total): void
    {
        $this->total = $total;
    }

    /**
     * @return int
     */
    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /**
     * @param int $perPage
     */
    public function setPerPage(int $perPage): void
    {
        $this->perPage = $perPage;
    }
}