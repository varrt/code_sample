<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\Score;
use Ramsey\Uuid\UuidInterface;

final readonly class AddScoreForStudentCommand
{
    public function __construct(
        public UuidInterface $groupId,
        public UuidInterface $studentId,
        public Score $score
    ) {
    }
}
