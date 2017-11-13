<?php
namespace PruneMazui\ZephirIdeHelper\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Parser;

class ParserTest extends TestCase
{
    public function testAddDirectory()
    {
        $parser = new Parser();

        $dir = __DIR__ . '/../files/';

        $parser->add($dir);

        assertCount(3, $parser->getFiles());

        if (! function_exists('zephir_parse_file')) {
            return $this->markTestSkipped('function `zephir_parse_file` not found. enable `Zephir Parser` extension.');
        }

        foreach ($parser->getParseResultGenerator() as $ret) {
            assertTrue(is_array($ret));
            assertNotEmpty($ret);
        }

        assertCount(0, $parser->clearFiles()->getFiles());
    }

    public function testFileNotFound()
    {
        $parser = new Parser();

        assertCount(0, $parser->getFiles());

        $parser->add(__DIR__ . '/NOT_FOUND_FILE');

        assertCount(0, $parser->getFiles());

        foreach ($parser->getParseResultGenerator() as $ret) {
            $this->fail('not operation code');
        }
    }

    public function testParseResult()
    {
        if (! function_exists('zephir_parse_file')) {
            return $this->markTestSkipped('function `zephir_parse_file` not found. enable `Zephir Parser` extension.');
        }

        $file = __DIR__ . '/../files/greeting.zep';

        $excepted = include __DIR__ . '/../files/parse_result.php';

        assertEquals($excepted, (new Parser())->parse($file));

    }
}
