<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class ChangeScoreForStudentCommandHandler
{
    public function __construct(
        private GroupRepositoryInterface $groupRepository
    ) {
    }

    public function __invoke(ChangeScoreForStudentCommand $command): void
    {
        $group = $this->groupRepository->getById($command->groupId);
        Assert::notNull($group);

        $student = $group->findStudent($command->studentId);
        Assert::notNull($student);

        Assert::same($command->oldScore->type, $command->newScore->type);
        $student->changeScore($command->oldScore->score, $command->newScore->score, $command->oldScore->type);
        $this->groupRepository->save($group);
    }
}
