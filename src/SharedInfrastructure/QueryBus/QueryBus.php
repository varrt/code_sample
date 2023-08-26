<?php

namespace Pmaj\SampleCode\SharedInfrastructure\QueryBus;

use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository\GroupInMemoryRepository;

class QueryBus
{
    private GroupRepositoryInterface $groupRepository;

    public function __construct(
        ?GroupRepositoryInterface $groupRepository = null
    ) {
        $this->groupRepository = $groupRepository ?? new GroupInMemoryRepository();
    }

    public function dispatch($command): array
    {
        $queryCommandClass = \get_class($command);
        $queryHandlerClass = $queryCommandClass.'Handler';

        return (new $queryHandlerClass($this->groupRepository))->__invoke($command);
    }
}
