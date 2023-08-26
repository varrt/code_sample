<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\ValueObject;

use Pmaj\SampleCode\SchoolDiary\Domain\Enum\ScoreWeight;

final class Score
{
    public function __construct(
        public int $score,
        public readonly ScoreWeight $type
    ) {}
}
