<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Command;

use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\Score;

final readonly class AddScoreForStudentCommand
{
    public function __construct(
        public UuidInterface $groupId,
        public UuidInterface $studentId,
        public Score $score
    ) {}
}
