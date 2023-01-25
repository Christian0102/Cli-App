<?php
declare(strict_types=1);
namespace Kernel;

use ErrorException;
use Kernel\BaseCommand;

class App
{
    protected array $instances;

    protected string $defaultPath = '/config/provider.php';

    public function __construct()
    {
        if (!file_exists(ROOT . $this->defaultPath)) {
            new ErrorException('File is not found ' . $this->defaultPath);
        }
        $classes = require_once(ROOT . $this->defaultPath);

        $this->registry($classes);
    }


    public function run(): void
    {
        $this->getCommands();
        echo PHP_EOL;
        $commandName = readline('Select Command("Example: Test Command"): ');

        echo PHP_EOL;

        foreach ($this->instances as $instance) {
            if (array_key_first($instance) == $commandName) {
                $instance[$commandName]->execute();
            }
        }
    }

    protected function getCommands()
    {
        echo PHP_EOL . 'List of Commands: ';
        foreach ($this->instances as $key => $value) {
            echo PHP_EOL;
            echo key($value);
        }
    }

    private function registry(array $classes): void
    {
        foreach ($classes as $class) {
            if (!class_exists($class)) {
                throw new ErrorException($class . ' class not found', 1001, 1);
            }

            $command = new $class();

            if (!$command instanceof BaseCommand) {
                throw new ErrorException($class . ' Class is not instance of \Kernel\BaseCommand ', 1004, 1);
            }

            $this->instances[] = [$command->getName() => $command];
        }
    }

}