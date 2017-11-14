<?php
namespace PruneMazui\ZephirIdeHelper\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Definition;

class DefinitionTest extends TestCase
{
    private $output;

    protected function setUp()
    {
        $this->output = __DIR__ . '/../files/__zephir_ide_helper.php';
        if (file_exists($this->output)) {
            unlink($this->output);
        }
    }

    public function testAllFlow()
    {
        $parse_result = include __DIR__ . '/../files/parse_result.php';

        $definition = new Definition();
        $definition->reflectParse($parse_result);

        assertCount(1, $definition->getNamespaces());

        $namespace = $definition->getNamespaces()[0];
        assertCount(2, $namespace->getUses());
        assertCount(1, $namespace->getClasses());

        $class = $namespace->getClasses()[0];
        assertEquals('Greeting', $class->getName());
        assertNotEmpty($class->getComment());

        assertCount(1, $class->getConstants());
        assertCount(2, $class->getProperties());
        assertCount(8, $class->getMethods()); // shutcut(get, get, set, toString + method(4)

        assertFalse(class_exists('\\PruneMazui\\Zephir\\Utils\\Greeting'));

        file_put_contents(__DIR__ . '/../files/__zephir_ide_helper.php', $definition->encode());
        require_once __DIR__ . '/../files/__zephir_ide_helper.php';

        assertTrue(class_exists('\\PruneMazui\\Zephir\\Utils\\Greeting'));
    }
}
