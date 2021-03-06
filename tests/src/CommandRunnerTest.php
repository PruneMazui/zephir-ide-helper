<?php
namespace PruneMazui\ZephirIdeHelper\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\CommandRunner;
use Psr\Log\NullLogger;
use Psr\Log\LoggerInterface;

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

        assertTrue((new CommandRunner(new NullLogger()))->run([
            'script_file_name',
            '-f',
            $file,
            __DIR__ . '/../files',
        ]));

        assertTrue(file_exists($file));
    }

    public function testFailure()
    {
        $runner = new CommandRunner(new NullLogger());

        try {
            $runner->run([]);
            $this->fail('excepted throw by illegal argument.');
        } catch (\RuntimeException $ex) {
            $this->addToAssertionCount(1);
        }

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

        assertFalse($runner->run([
            'script_file_name',
            __DIR__ . '/not_exist_file'
        ]));
    }

    public function testDefaultLogger()
    {
        $runner = new CommandRunner();
        $logger = $runner->getLogger();

        assertInstanceOf(LoggerInterface::class, $logger);

        $content = 'logging test';
        ob_start();

        $logger->info($content);

        $flushed = ob_get_contents();
        ob_end_clean();

        assertContains($content, $flushed);
    }
}
