<?php

namespace App\Pagination\ArgumentResolver;

use App\Pagination\PaginationQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Controller\ArgumentValueResolverInterface;
use Symfony\Component\HttpKernel\ControllerMetadata\ArgumentMetadata;

class PaginationQueryResolver implements ArgumentValueResolverInterface
{
    public function supports(Request $request, ArgumentMetadata $argument)
    {
        return $argument->getType() === PaginationQuery::class;
    }

    public function resolve(Request $request, ArgumentMetadata $argument)
    {
        yield new PaginationQuery(
            $request->query->getInt('page', 1),
            $request->query->getInt('limit', 25)
        );
    }
}