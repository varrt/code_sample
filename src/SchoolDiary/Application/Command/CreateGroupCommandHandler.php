<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Webmozart\Assert\Assert;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;

readonly class CreateGroupCommandHandler
{
    public function __construct(
        private GroupRepositoryInterface $groupRepository
    )
    {
    }

    public function __invoke(CreateGroupCommand $command): void
    {
        $group = $this->groupRepository->getById($command->groupId);
        Assert::null($group);

        $group = new Group(
            $command->groupId,
            $command->teacher,
            $command->groupName
        );

        $this->groupRepository->save($group);
    }
}
