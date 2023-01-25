<?php
declare(strict_types=1);

namespace Commands;

use Kernel\BaseCommand;
use ErrorException;

class Calculator extends BaseCommand
{
    protected string $description = 'CLI Simple Calculator:';

    protected string $name = 'Calculator';

    public function __construct()
    {
        parent::__construct($this->name);

    }

    public function execute(): void
    {
        echo $this->description . PHP_EOL;
        $operation = readline('Select the operation: ' . PHP_EOL . '+' . PHP_EOL . '-' . PHP_EOL . '*' . PHP_EOL . '/' . PHP_EOL . 'sqrt' . PHP_EOL . ':');

        if (!in_array($operation, ['+', '-', '*', '/', 'sqrt'])) {
            throw new ErrorException($operation . ' Operation  not found', 1001, 1);
        }
        echo 'Result is: ' . $this->calculate($operation) . PHP_EOL;
    }

    protected function calculate(string $operation)
    {
        $firstValue = 0;
        $secondValue = 0;

        $firstValue = readline('Enter the first value');
        if ($operation !== 'sqrt') {
            $secondValue = readline('Enter the second value');
        }

        if (!is_numeric($firstValue) || !is_numeric($secondValue)) {
            throw new ErrorException('set value is not numeric');
        }

        return match ($operation) {
            '+' => $firstValue + $secondValue,
            '-' => $firstValue - $secondValue,
            '*' => $firstValue * $secondValue,
            '/' => $firstValue / $secondValue,
            'sqrt' => sqrt((float) $firstValue),
        };

    }

}