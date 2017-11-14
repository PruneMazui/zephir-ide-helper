<?php
namespace PruneMazui\ZephirIdeHelper\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\CommandRunner;

class CommandRunnerTest extends TestCase
{
    public function testSuccessFlow()
    {
        if (! function_exists('zephir_parse_file')) {
            return $this->markTestSkipped('function `zephir_parse_file` not found. enable `Zephir Parser` extension.');
        }

        $file = __DIR__ . '/../files/output.php';
        if (file_exists($file)) {
            unlink($file);
        }

        ob_start();
        assertTrue((new CommandRunner())->run([
            'script_file_name',
            '-f',
            $file,
            __DIR__ . '/../files',
        ]));
        ob_end_clean();

        assertTrue(file_exists($file));
    }

    public function testFailure()
    {
        $runner = new CommandRunner();

        try {
            $runner->run([]);
            $this->fail('excepted throw by illegal argument.');
        } catch (\RuntimeException $ex) {
            $this->addToAssertionCount(1);
        }

        ob_start();

        assertFalse($runner->run(['script_file_name']));

        assertFalse($runner->run([
            'script_file_name',
            '-f',
            'export_target'
        ]));

        assertFalse($runner->run([
            'script_file_name',
            '-fuga',
            'export_target'
        ]));

        assertFalse($runner->run([
            'script_file_name',
            __FILE__
        ]));

        ob_end_clean();
    }
}
