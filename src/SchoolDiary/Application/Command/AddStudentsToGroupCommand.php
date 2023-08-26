<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Student;

final readonly class AddStudentsToGroupCommand
{
    public function __construct(
        public UuidInterface $groupId,
        /** @var array<Student> */
        public array $students
    ) {}
}
