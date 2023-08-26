<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\Repository;

use Pmaj\SampleCode\SchoolDiary\Domain\Group;
use Ramsey\Uuid\UuidInterface;

interface GroupRepositoryInterface
{
    public function save(Group $group): void;

    public function getById(UuidInterface $groupId): Group;

    public function findById(UuidInterface $groupId): ?Group;
}
