<?php

namespace Pmaj\SampleCode\SharedInfrastructure\CommandBus;

use Pmaj\SampleCode\SchoolDiary\Domain\Repository\GroupRepositoryInterface;
use Pmaj\SampleCode\SchoolDiary\Infrastructure\Repository\GroupInMemoryRepository;

class CommandBus
{
    private GroupRepositoryInterface $groupRepository;

    public function __construct(
        ?GroupRepositoryInterface $groupRepository = null
    ) {
        $this->groupRepository = $groupRepository ?? new GroupInMemoryRepository();
    }

    public function dispatch($command): void
    {
        $commandClass = \get_class($command);
        $handlerClass = $commandClass.'Handler';
        (new $handlerClass($this->groupRepository))->__invoke($command);
    }
}
