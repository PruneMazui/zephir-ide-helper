<?php
namespace PruneMazui\ZephirIdeHelper\Element\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Element\MethodElement;

class MethodTest extends TestCase
{
    public function testSuccess()
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
