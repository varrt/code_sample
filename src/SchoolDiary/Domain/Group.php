<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain;

final class Group
{
    /** @var array<Student> */
    private array $students;

    public function __construct(
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
