<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\Score;
use Ramsey\Uuid\UuidInterface;

final readonly class ChangeScoreForStudentCommand
{
    public function __construct(
        public UuidInterface $groupId,
        public UuidInterface $studentId,
        public Score $oldScore,
        public Score $newScore,
    ) {
    }
}
