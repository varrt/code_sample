<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\Student;
use Ramsey\Uuid\UuidInterface;

final readonly class AddStudentsToGroupCommand
{
    public function __construct(
        public UuidInterface $groupId,
        /** @var array<Student> */
        public array $students
    ) {
    }
}
