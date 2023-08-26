<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class AddScoreForStudentCommandHandler
{
    public function __construct(
        private GroupRepositoryInterface $groupRepository
    ) {
    }

    public function __invoke(AddScoreForStudentCommand $command): void
    {
        $group = $this->groupRepository->getById($command->groupId);
        Assert::notNull($group);

        $student = $group->findStudent($command->studentId);
        Assert::notNull($student);

        $student->addScore($command->score->score, $command->score->type);

        $this->groupRepository->save($group);
    }
}
