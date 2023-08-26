<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain;

use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FinalScore;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\Score;
use Pmaj\SampleCode\SchoolDiary\Domain\Enum\ScoreWeight;
use Pmaj\SampleCode\SchoolDiary\Domain\Exception\ScoreNotFoundException;

class Student
{
    /** @var array<Score> */
    private array $scores;
    private ?FinalScore $finalScore = null;
    public function __construct(
        public readonly UuidInterface $id,
        public readonly FullName $fullName,
    )
    {
        $this->scores = [];
    }

    public function getScores(): array
    {
        return $this->scores;
    }

    public function getFinalScore(): ?FinalScore
    {
        return $this->finalScore;
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
                return;
            }
        }
        throw new ScoreNotFoundException();
    }

    public function calculateFinalScore(): void
    {
        $sumHomeworkScores = 0;
        $sumActivityScores = 0;
        $sumTestsScores = 0;

        $countHomeworkScores = 0;
        $countActivityScores = 0;
        $countTestsScores = 0;

        foreach ($this->scores as $score) {
            switch ($score->type) {
                case ScoreWeight::ACTIVITY:
                    $sumActivityScores += $score->score;
                    $countActivityScores++;
                    break;
                case ScoreWeight::HOMEWORK:
                    $sumHomeworkScores += $score->score;
                    $countHomeworkScores++;
                    break;
                case ScoreWeight::TEST:
                    $sumTestsScores += $score->score;
                    $countTestsScores++;
                    break;
            }
        }

        $score = (
                $sumActivityScores * ScoreWeight::ACTIVITY->value +
                $sumHomeworkScores * ScoreWeight::HOMEWORK->value +
                $sumTestsScores * ScoreWeight::TEST->value
            ) / (
                $countActivityScores * ScoreWeight::ACTIVITY->value +
                $countHomeworkScores * ScoreWeight::HOMEWORK->value +
                $countTestsScores * ScoreWeight::TEST->value
        );

        $this->finalScore = new FinalScore(number_format($score, 2));
    }
}
