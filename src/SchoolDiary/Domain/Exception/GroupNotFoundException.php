<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\Exception;

class GroupNotFoundException extends \Exception
{
    protected $message = "Group not found";
}
