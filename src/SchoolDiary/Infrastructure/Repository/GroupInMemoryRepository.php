<?php

namespace Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository;

use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Exception\GroupNotFoundException;

class GroupInMemoryRepository implements GroupRepositoryInterface
{
    private array $memory = [];
    public function save(Group $group): void
    {
        $this->memory[$group->id->toString()] = $group;
    }

    public function getById(UuidInterface $groupId): Group
    {
        return $this->memory[$groupId->toString()] ?? throw new GroupNotFoundException();
    }

    public function findById(UuidInterface $groupId): ?Group
    {
        return $this->memory[$groupId->toString()] ?? null;
    }
}
