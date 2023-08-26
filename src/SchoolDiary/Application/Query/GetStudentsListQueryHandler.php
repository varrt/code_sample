<?php

namespace Pmaj\SampleCode\SchoolDiary\Application\Query;

use Pmaj\SampleCode\SchoolDiary\Application\Query\DTO\StudentDTO;
use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Webmozart\Assert\Assert;

readonly class GetStudentsListQueryHandler
{
    public function __construct(
        private GroupRepositoryInterface $groupRepository
    ) {
    }

    public function __invoke(GetStudentsListQuery $query): array
    {
        $group = $this->groupRepository->getById($query->groupId);
        Assert::notNull($group);

        $students = [];
        foreach ($group->getStudents() as $student) {
            $students[] = StudentDTO::fromEntity($student);
        }

        return $students;
    }
}
