<?php

namespace unit\SchoolDiary;

use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\CoversClass;
use Pmaj\SampleCode\SchoolDiary\Domain\Student;
use PHPUnit\Framework\Attributes\Test;
use Ramsey\Uuid\Uuid;
use Pmaj\SampleCode\SchoolDiary\Domain\ValueObject\FullName;
use PHPUnit\Framework\Assert;
use Pmaj\SampleCode\SchoolDiary\Domain\Enum\ScoreWeight;
use Pmaj\SampleCode\SchoolDiary\Domain\Exception\ScoreNotFoundException;

#[CoversClass(Student::class)]
class StudentScoreTest extends TestCase
{
    private Student $student;

    protected function setUp(): void
    {
        parent::setUp();
        $this->student = new Student(Uuid::uuid4(), new FullName("Paul", "Maj"));
    }


    #[Test]
    public function shouldAddScoreForStudent(): void
    {
        Assert::assertCount(0, $this->student->getScores());
        $this->student->addScore(3, ScoreWeight::ACTIVITY);
        $this->student->addScore(4, ScoreWeight::HOMEWORK);
        $this->student->addScore(2, ScoreWeight::TEST);
        Assert::assertCount(3, $this->student->getScores());
    }

    #[Test]
    public function shouldCanImproveScore(): void
    {
        Assert::assertCount(0, $this->student->getScores());
        $this->student->addScore(3, ScoreWeight::ACTIVITY);
        $this->student->addScore(4, ScoreWeight::HOMEWORK);
        $this->student->addScore(2, ScoreWeight::TEST);
        $this->student->changeScore(3, 6, ScoreWeight::ACTIVITY);
        Assert::assertCount(3, $this->student->getScores());
    }

    #[Test]
    public function shouldCannotImproveScoreWhenOldScoreNotExists(): void
    {
        Assert::assertCount(0, $this->student->getScores());
        $this->student->addScore(3, ScoreWeight::ACTIVITY);
        $this->student->addScore(4, ScoreWeight::HOMEWORK);
        $this->student->addScore(2, ScoreWeight::TEST);
        $this->expectException(ScoreNotFoundException::class);
        $this->expectExceptionMessage("Score not found");
        $this->student->changeScore(4, 6, ScoreWeight::ACTIVITY);
    }

    #[Test]
    public function shouldCalculateFinalScore(): void
    {
        Assert::assertNull($this->student->getFinalScore());
        $this->student->addScore(4, ScoreWeight::HOMEWORK);
        $this->student->addScore(3, ScoreWeight::ACTIVITY);
        $this->student->addScore(2, ScoreWeight::TEST);

        $this->student->calculateFinalScore();

        Assert::assertSame(2.67, $this->student->getFinalScore()?->score);
    }
}
