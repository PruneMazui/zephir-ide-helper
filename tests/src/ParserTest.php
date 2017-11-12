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

        foreach ($parser->getParseResultGenerator() as $ret) {
            assertTrue(is_array($ret));
            assertNotEmpty($ret);
        }
    }
}
