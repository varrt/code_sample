<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Teacher;

final readonly class CreateGroupCommand
{
    public function __construct(
        public UuidInterface $groupId,
        public Teacher $teacher,
        public string $groupName
    ) {}
}
