<?php

namespace integration\SchoolDiary;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Pmaj\SampleCode\SchoolDiary\Application\Command\ChangeScoreForStudentCommand;
use Pmaj\SampleCode\SchoolDiary\Application\Command\ChangeScoreForStudentCommandHandler;
use Pmaj\SampleCode\SchoolDiary\Domain\Enum\ScoreWeight;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Student;
use Pmaj\SampleCode\SchoolDiary\Domain\Teacher;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\Score;
use Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository\GroupInMemoryRepository;
use Pmaj\SampleCode\SharedInfrastructure\CommandBus\CommandBus;
use Ramsey\Uuid\Uuid;

/**
 * @internal
 *
 * @coversNothing
 */
#[CoversClass(ChangeScoreForStudentCommandHandler::class)]
final class ChangeScoreForStudentCommandHandlerTest extends TestCase
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
    public function shouldChangeScoreForStudent(): void
    {
        // given
        $groupId = Uuid::uuid4();
        $studentId = Uuid::uuid4();
        $group = new Group($groupId, new Teacher(new FullName('Paul', 'Smith')), 'Class 1A');
        $student = new Student($studentId, new FullName('John', 'Snow'));
        $student->addScore(3, ScoreWeight::TEST);
        $group->addStudent($student);
        $this->groupRepository->save($group);

        // when
        $this->bus->dispatch(new ChangeScoreForStudentCommand(
            $groupId,
            $studentId,
            new Score(3, ScoreWeight::TEST),
            new Score(6, ScoreWeight::TEST)
        ));

        // then
        $student = $group->findStudent($studentId);
        Assert::assertNotNull($student);
        Assert::assertSame(6, $student->getScores()[0]->score);
    }
}
