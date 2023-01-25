<?php
declare(strict_types=1);

namespace Commands;

use Kernel\BaseCommand;

class TestCommand extends BaseCommand
{

    protected string $name = 'Test Command';

    protected string $description = 'Simple Test Command';

    public function __construct()
    {
        parent::__construct($this->name);
    }

    public function execute(): void
    {
        echo 'Test Comand' . PHP_EOL;
    }

    public function getName(): string
    {
        return $this->name;
    }
}