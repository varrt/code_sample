<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\ValueObject;

final readonly class FullName
{
    public function __construct(
        public string $firstName,
        public string $lastName
    ) {}
}
