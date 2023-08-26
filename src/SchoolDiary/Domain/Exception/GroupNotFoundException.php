<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\Exception;

class GroupNotFoundException extends \Exception
{
    public function __construct(string $message = 'Group not found', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
