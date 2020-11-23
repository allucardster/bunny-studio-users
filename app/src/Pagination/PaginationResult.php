<?php

namespace App\Pagination;

use Doctrine\ORM\EntityRepository;
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
     * @var int
     */
    private int $page;

    /**
     * PaginationResult constructor.
     * @param array $results
     * @param int $total
     * @param int $perPage
     * @param int $page
     */
    public function __construct(array $results, int $total, int $perPage, int $page)
    {
        $this->results = $results;
        $this->total = $total;
        $this->perPage = $perPage;
        $this->page = $page;
    }

    /**
     * @param EntityRepository $repository
     * @param PaginationQuery $paginationQuery
     * @param array $criteria
     * @return PaginationResult
     */
    public static function createFrom(EntityRepository $repository, PaginationQuery $paginationQuery, array $criteria = []): PaginationResult
    {
        $results = $repository->findBy($criteria, null, $paginationQuery->getLimit(), $paginationQuery->getOffset());
        $total = count($results);
        if (0 !== $total) {
            $total = $repository->count($criteria);
        }

        return new self($results, $total, $paginationQuery->getLimit(), $paginationQuery->getPage());
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

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @param int $page
     */
    public function setPage(int $page): void
    {
        $this->page = $page;
    }
}