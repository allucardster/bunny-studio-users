<?php

namespace App\Entity;

use MyCLabs\Enum\Enum;

/**
 * @method static UserTaskState TODO()
 * @method static UserTaskState DONE()
 */
class UserTaskState extends Enum
{
    private const TODO = 'to do';
    private const DONE = 'done';
}