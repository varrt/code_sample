<?php

namespace integration\SchoolDiary;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Pmaj\SampleCode\SchoolDiary\Application\Query\GetStudentsListQuery;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Student;
use Pmaj\SampleCode\SchoolDiary\Domain\Teacher;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository\GroupInMemoryRepository;
use Pmaj\SampleCode\SharedInfrastructure\QueryBus\QueryBus;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(GetStudentsListQuery::class)]
final class GetStudentsListQueryHandlerTest extends TestCase
{
    private QueryBus $bus;
    private GroupRepositoryInterface $groupRepository;

    protected function setUp(): void
    {
        $this->groupRepository = new GroupInMemoryRepository();
        $this->bus = new QueryBus($this->groupRepository);
        parent::setUp();
    }

    #[Test]
    public function shouldGetStudentsListInGroup(): void
    {
        // given
        $groupId = Uuid::uuid4();
        $group = new Group($groupId, new Teacher(new FullName('Paul', 'Smith')), 'Class 1A');
        $group->addStudent(new Student(Uuid::uuid4(), new FullName('John', 'Snow')));
        $group->addStudent(new Student(Uuid::uuid4(), new FullName('Cris', 'Sand')));
        $group->addStudent(new Student(Uuid::uuid4(), new FullName('Matt', 'Wind')));
        $group->addStudent(new Student(Uuid::uuid4(), new FullName('Adam', 'Rock')));
        $this->groupRepository->save($group);

        // when
        $students = $this->bus->dispatch(new GetStudentsListQuery($groupId));

        // then
        Assert::assertCount(4, $students);
    }
}
