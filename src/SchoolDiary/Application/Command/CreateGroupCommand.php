<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\Teacher;
use Ramsey\Uuid\UuidInterface;

final readonly class CreateGroupCommand
{
    public function __construct(
        public UuidInterface $groupId,
        public Teacher $teacher,
        public string $groupName
    ) {
    }
}
