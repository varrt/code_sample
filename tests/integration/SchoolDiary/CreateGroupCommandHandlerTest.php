<?php

namespace integration\SchoolDiary;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Pmaj\SampleCode\SchoolDiary\Application\Command\CreateGroupCommand;
use PHPUnit\Framework\Attributes\Test;
use Pmaj\SampleCode\SharedInfrastructure\CommandBus\CommandBus;
use Ramsey\Uuid\Uuid;
use Pmaj\SampleCode\SchoolDiary\Domain\Teacher;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository\GroupInMemoryRepository;
use PHPUnit\Framework\Assert;

#[CoversClass(CreateGroupCommand::class)]
class CreateGroupCommandHandlerTest extends TestCase
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
    public function shouldCreateNewGroup(): void
    {
        // when
        $groupId = Uuid::uuid4();
        $this->bus->dispatch(new CreateGroupCommand(
            $groupId,
            new Teacher(
                new FullName("Paul", "Smith")
            ),
            "Class 1A"
        ));

        //then
        $group = $this->groupRepository->getById($groupId);
        Assert::assertNotNull($group);
    }
}
