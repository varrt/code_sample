<?php

namespace unit\SchoolDiary;

use Pmaj\SampleCode\SchoolDiary\Domain\Teacher;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Assert;
use Pmaj\SampleCode\SchoolDiary\Domain\Student;
use Ramsey\Uuid\Uuid;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(Group::class)]
class CreateGroupTest extends TestCase
{
    #[Test]
    public function shouldCreateGroupAndAddStudents(): void
    {
        $teacher = new Teacher(new FullName("John", "Smith"));
        $group = new Group($teacher, "Class 1A");

        Assert::assertSame($teacher->fullName, $group->teacher->fullName);
        Assert::assertSame('Class 1A', $group->groupName);
        Assert::assertCount(0, $group->getStudents());

        $group->addStudent(new Student(Uuid::uuid4(), new FullName("Paul", "Jones")));
        $group->addStudent(new Student(Uuid::uuid4(), new FullName("Cris", "Thomas")));
        $group->addStudent(new Student(Uuid::uuid4(), new FullName("Patric", "Evans")));

        Assert::assertCount(3, $group->getStudents());
    }
}
