<?php
namespace PruneMazui\ZephirIdeHelper\Element\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Element\ArgumentElement;
use PruneMazui\ZephirIdeHelper\Element\DefaultValueElement;
use PruneMazui\ZephirIdeHelper\DefinitionException;

class ArgumentElementTest extends TestCase
{
    public function testSuccess()
    {
        $arg = ArgumentElement::factory('hoge');
        assertEquals('hoge', $arg->getName());
        assertFalse($arg->hasDefaultValue());
        assertNull($arg->getDataType());

        // --------------------------------------

        $params = [
            'type' => 'parameter',
            'name' => 'hoge',
        ];

        $arg = ArgumentElement::factory($params);
        assertEquals('hoge', $arg->getName());
        assertFalse($arg->hasDefaultValue());
        assertNull($arg->getDefaultValue());
        assertNull($arg->getDataType());

        // --------------------------------------

        $params = [
            'type' => 'parameter',
            'name' => 'fuga',
            'data-type' => 'array',
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

    public function testFailure()
    {
        try {
            ArgumentElement::factory(123);
            $this->fail('excepted throw by invalid argument.');
        } catch (DefinitionException $ex) {
            $this->addToAssertionCount(1);
        }

        // --------------------------------------

        try {
            ArgumentElement::factory([
                'type' => 'not_parameter',
                'name' => 'fuga',
            ]);
            $this->fail('excepted throw by miss match type.');
        } catch (DefinitionException $ex) {
            $this->addToAssertionCount(1);
        }

        // --------------------------------------

        try {
            ArgumentElement::factory([
                'type' => 'parameter',
                'name' => '',
            ]);
            $this->fail('excepted throw by name is empty.');
        } catch (DefinitionException $ex) {
            $this->addToAssertionCount(1);
        }
    }
}
