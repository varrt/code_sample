<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain;

use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;

final readonly class Teacher
{
    public function __construct(
        public FullName $fullName
    )
    {

    }
}
