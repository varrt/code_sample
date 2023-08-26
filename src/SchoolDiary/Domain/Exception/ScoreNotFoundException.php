<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\Exception;

class ScoreNotFoundException extends \Exception
{
    protected $message = 'Score not found';
}
