<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use JetBrains\PhpStorm\NoReturn;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class CreateGroupCommandHandler
{
    public function __construct(
        private GroupRepositoryInterface $groupRepository
    ) {
    }

    #[NoReturn]
    public function __invoke(CreateGroupCommand $command): void
    {
        $group = $this->groupRepository->findById($command->groupId);
        Assert::null($group);

        $group = new Group(
            $command->groupId,
            $command->teacher,
            $command->groupName
        );

        $this->groupRepository->save($group);
    }
}
