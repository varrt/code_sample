<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\Score;

final readonly class ChangeScoreForStudentCommand
{
    public function __construct(
        public UuidInterface $groupId,
        public UuidInterface $studentId,
        public Score $oldScore,
        public Score $newScore,
    ) {}
}
