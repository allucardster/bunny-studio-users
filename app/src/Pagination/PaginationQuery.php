<?php

namespace App\Pagination;

use InvalidArgumentException;

class PaginationQuery
{
    /**
     * @var int
     */
    private int $page;

    /**
     * @var int
     */
    private int $limit;

    /**
     * @var int
     */
    private int $offset;

    /**
     * PaginationQuery constructor.
     * @param int $page
     * @param int $limit
     */
    public function __construct(int $page, int $limit)
    {
        if ($page < 1) {
            throw new InvalidArgumentException('The given "page" can not be less than 1');
        }

        if ($limit < 1) {
            throw new InvalidArgumentException('The given "limit" can not be less than 1');
        }

        $this->page = $page;
        $this->limit = $limit;
        $this->offset = $this->limit * ($this->page - 1);
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }

    /**
     * @return int
     */
    public function getLimit(): int
    {
        return $this->limit;
    }

    /**
     * @return int
     */
    public function getOffset(): int
    {
        return $this->offset;
    }
}