<?php

namespace App\Request;

interface UpdateRequestInterface
{
    public function isDirty(): bool;
}