<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Query;

use Ramsey\Uuid\UuidInterface;

final readonly class GetStudentsListQuery
{
    public function __construct(
        public UuidInterface $groupId
    )
    {

    }
}
