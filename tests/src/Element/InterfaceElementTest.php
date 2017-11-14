<?php
namespace PruneMazui\ZephirIdeHelper\Element\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Element\InterfaceElement;

class InterfaceElementTest extends TestCase
{
    public function testSuccess()
    {
        $params = [
            'type' => 'interface',
            'name' => 'SampleInterface',
            'definition' => [
                'methods' => [
                    [
                        'visibility' => [
                            'public'
                        ],
                        'type' => 'method',
                        'name' => 'hoge'
                    ],
                    [
                        'visibility' => [
                            'public'
                        ],
                        'type' => 'method',
                        'name' => 'fuga',
                        'parameters' => [
                            [
                                'type' => 'parameter',
                                'name' => 'word',
                                'const' => 0,
                                'data-type' => 'string',
                                'mandatory' => 0,
                                'reference' => 0
                            ]
                        ]
                    ],
                    [
                        'visibility' => [
                            'public'
                        ],
                        'type' => 'method',
                        'name' => 'piyo',
                        'return-type' => [
                            'type' => 'return-type',
                            'list' => [
                                [
                                    'type' => 'return-type-parameter',
                                    'data-type' => 'string',
                                    'mandatory' => 0
                                ]
                            ],
                            'void' => 0
                        ]
                    ]
                ]
            ]
        ];

        $interface = InterfaceElement::factory($params, '');

        assertEquals('SampleInterface', $interface->getName());
        assertFalse($interface->isAbstract());
        assertFalse($interface->isStatic());
        assertFalse($interface->isFinal());
        assertFalse($interface->isDeprecated());

        assertCount(3, $interface->getMethods());

        assertFalse(interface_exists('SampleInterface'));
        eval($interface->encode());
        assertTrue(interface_exists('SampleInterface'));
    }
}
