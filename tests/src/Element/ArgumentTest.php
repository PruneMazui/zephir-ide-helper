<?php
namespace PruneMazui\ZephirIdeHelper\Element\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Element\ArgumentElement;
use PruneMazui\ZephirIdeHelper\Element\DefaultValueElement;

class ArgumentTest extends TestCase
{
    public function testSuccess()
    {
        $arg = ArgumentElement::factory('hoge');
        assertEquals('hoge', $arg->getName());
        assertFalse($arg->hasDefaultValue());
        assertNull($arg->getDataType());

        $params = [
            'type' => 'parameter',
            'name' => 'fuga',
            'const' => 0,
            'data-type' => 'array',
            'mandatory' => 0,
            'default' => [
                'type' => 'null'
            ]
        ];

        $arg = ArgumentElement::factory($params);
        assertEquals('fuga', $arg->getName());
        assertTrue($arg->hasDefaultValue());
        assertInstanceOf(DefaultValueElement::class, $arg->getDefaultValue());
        assertEquals('array', $arg->getDataType());
    }
}
