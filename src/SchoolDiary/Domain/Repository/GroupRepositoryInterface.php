<?php

namespace Pmaj\SampleCode\SchoolDiary\Domain\Repository;

use Ramsey\Uuid\UuidInterface;
use Pmaj\SampleCode\SchoolDiary\Domain\Group;

interface GroupRepositoryInterface
{
    public function save(Group $group): void;

    public function getById(UuidInterface $groupId): Group;

    public function findById(UuidInterface $groupId): ?Group;
}
