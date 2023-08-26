<?php

namespace Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository;

use Pmaj\SampleCode\SchoolDiary\Domain\Exception\GroupNotFoundException;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Ramsey\Uuid\UuidInterface;

class GroupInMemoryRepository implements GroupRepositoryInterface
{
    /** @var array<string, Group> */
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
