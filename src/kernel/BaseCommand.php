<?php
declare(strict_types=1);
namespace Kernel;

use ErrorException;

abstract class BaseCommand
{
    protected string $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract function execute(): void;

    public function getName(): string|ErrorException
    {
        if (empty($this->name)) {
            throw new ErrorException("Name of command isn'\ set ", 1002, 1);
        }
        return $this->name;
    }
}