<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain;

use Ramsey\Uuid\UuidInterface;

final class Group
{
    /** @var array<Student> */
    private array $students;

    public function __construct(
        public readonly UuidInterface $id,
        public readonly Teacher $teacher,
        public readonly string $groupName
    ) {
        $this->students = [];
    }

    public function getStudents(): array
    {
        return $this->students;
    }

    public function addStudent(Student $student): void
    {
        $this->students[] = $student;
    }
}
