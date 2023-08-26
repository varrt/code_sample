<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Query\DTO;

use Pmaj\SampleCode\SchoolDiary\Domain\Student;

final readonly class StudentDTO implements \JsonSerializable
{
    public function __construct(
        public string $id,
        public string $firstName,
        public string $lastName,
        public float $finalScore
    ) {
    }

    public static function fromEntity(Student $student): self
    {
        return new self(
            $student->id->toString(),
            $student->fullName->firstName,
            $student->fullName->lastName,
            $student->getFinalScore()?->score
        );
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
            'finalScore' => $this->finalScore,
        ];
    }
}
