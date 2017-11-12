<?php
namespace PruneMazui\ZephirIdeHelper\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Definition;
use PruneMazui\ZephirIdeHelper\Parser;

class AllTest extends TestCase
{
    public function testAllFlow()
    {
        $file = __DIR__ . '/../files/greeting.zep';

        $parser = new Parser();

        $parse_result = $parser->parse($file);

        $definition = new Definition();
        $definition->reflectParse($parse_result);

        assertCount(1, $definition->getNamespaces());

        $namespace = $definition->getNamespaces()[0];
        assertCount(1, $namespace->getUses());
        assertCount(1, $namespace->getClasses());

        $class = $namespace->getClasses()[0];
        assertEquals('Greeting', $class->getName());
        assertNotEmpty($class->getComment());

        assertCount(1, $class->getConstants());
        assertCount(2, $class->getProperties());
        assertCount(7, $class->getMethods()); // get, get, set, toString + method(3)
    }
}
