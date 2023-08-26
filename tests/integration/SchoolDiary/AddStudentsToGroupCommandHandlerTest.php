<?php

namespace integration\SchoolDiary;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Pmaj\SampleCode\SchoolDiary\Application\Command\AddStudentsToGroupCommand;
use Pmaj\SampleCode\SchoolDiary\Application\Command\AddStudentsToGroupCommandHandler;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Student;
use Pmaj\SampleCode\SchoolDiary\Domain\Teacher;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository\GroupInMemoryRepository;
use Pmaj\SampleCode\SharedInfrastructure\CommandBus\CommandBus;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(AddStudentsToGroupCommandHandler::class)]
final class AddStudentsToGroupCommandHandlerTest extends TestCase
{
    private CommandBus $bus;
    private GroupRepositoryInterface $groupRepository;

    protected function setUp(): void
    {
        $this->groupRepository = new GroupInMemoryRepository();
        $this->bus = new CommandBus($this->groupRepository);
        parent::setUp();
    }

    #[Test]
    public function shouldAddStudentToGroup(): void
    {
        // given
        $groupId = Uuid::uuid4();
        $group = new Group($groupId, new Teacher(new FullName('Paul', 'Smith')), 'Class 1A');
        $this->groupRepository->save($group);

        // when
        $studentId = Uuid::uuid4();
        $student = new Student($studentId, new FullName('John', 'Snow'));

        $this->bus->dispatch(new AddStudentsToGroupCommand(
            $groupId,
            [$student]
        ));

        // then
        $student = $group->findStudent($studentId);
        Assert::assertCount(1, $group->getStudents());
    }
}
