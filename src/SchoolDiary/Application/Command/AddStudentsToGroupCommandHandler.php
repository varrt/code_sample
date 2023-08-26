<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class AddStudentsToGroupCommandHandler
{
    public function __construct(
        private GroupRepositoryInterface $groupRepository
    ) {
    }

    public function __invoke(AddStudentsToGroupCommand $command): void
    {
        $group = $this->groupRepository->getById($command->groupId);
        Assert::notNull($group);

        foreach ($command->students as $student) {
            if (null === $group->findStudent($student->id)) {
                $group->addStudent($student);
            }
        }

        $this->groupRepository->save($group);
    }
}
