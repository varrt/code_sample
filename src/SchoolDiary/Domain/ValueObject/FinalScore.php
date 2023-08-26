<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\ValueObject;

final readonly class FinalScore
{
    public function __construct(
        public float $score
    ) {}
}
