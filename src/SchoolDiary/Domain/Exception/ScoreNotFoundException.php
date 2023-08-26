<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\Exception;

class ScoreNotFoundException extends \Exception
{
    public function __construct(string $message = 'Score not found', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
