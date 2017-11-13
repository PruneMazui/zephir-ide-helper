<?php
namespace PruneMazui\ZephirIdeHelper\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Element\NamespaceElement;
use PruneMazui\ZephirIdeHelper\Element\ArgumentElement;
use PruneMazui\ZephirIdeHelper\Element\MethodElement;
use PruneMazui\ZephirIdeHelper\Element\DefaultValueElement;

class ElementTest extends TestCase
{
    public function testNamespace()
    {
        $params = [
            'type' => 'namespace',
            'name' => 'Phalcon'
        ];

        $namespace = NamespaceElement::factory($params);

        assertEquals($params['name'], $namespace->getName());
        assertFalse($namespace->hasClass());
        assertFalse($namespace->hasUse());
    }

    public function testArgument()
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

    public function testMethod()
    {
        $params = [
            'visibility' => [
                'public'
            ],
            'type' => 'method',
            'name' => '__construct',
            'parameters' => [
                [
                    'type' => 'parameter',
                    'name' => 'validators',
                    'data-type' => 'array',
                    'default' => [
                        'type' => 'null'
                    ]
                ]
            ]
        ];

        $method = MethodElement::factory($params);

        assertEquals('__construct', $method->getName());
        assertTrue($method->isPublic());
        assertFalse($method->isAbstract());
        assertFalse($method->isDeprecated());
        assertFalse($method->isFinal());
        assertFalse($method->isStatic());

        assertTrue($method->hasArgument());
        assertCount(1, $method->getArguments());

        assertEmpty($method->getComment());

        // ---

        $params = [
            'visibility' => [
                'protected',
                'abstract',
                'final',
                'deprecated',
                'static',
            ],
            'type' => 'method',
            'name' => 'hoge',
            'docblock' => 'aaaa'
        ];

        $method = MethodElement::factory($params);

        assertEquals('hoge', $method->getName());
        assertFalse($method->isPublic());
        assertTrue($method->isAbstract());
        assertTrue($method->isDeprecated());
        assertTrue($method->isFinal());
        assertTrue($method->isStatic());

        assertFalse($method->hasArgument());
        assertCount(0, $method->getArguments());

        assertNotEmpty($method->getComment());
    }
}
