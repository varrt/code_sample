<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain;

use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FinalScore;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\Score;
use Pmaj\SampleCode\SchoolDiary\Domain\Enum\ScoreWeight;

class Student
{
    /** @var array<Score> */
    private array $scores;
    private ?FinalScore $finalScore = null;
    public function __construct(
        private UuidInterface $id,
        private FullName $fullName,
    )
    {
        $this->scores = [];
    }

    public function addScore(int $score, ScoreWeight $type): void
    {
        $this->scores[] = new Score($score, $type);
    }

    public function changeScore(int $oldScore, int $newScore, ScoreWeight $type): void
    {
        foreach ($this->scores as $score) {
            if ($score->score === $oldScore && $score->type === $type) {
                $score->score = $newScore;
            }
        }
    }

    public function calculateFinalScore(): void
    {
        $sumWeights = 0;
        $sum = 0;
        foreach ($this->scores as $score) {
            $sumWeights += $score->score * $score->type->value;
            $sum += $score->score;
        }

        $this->finalScore = new FinalScore($sumWeights / $sum);
    }
}
