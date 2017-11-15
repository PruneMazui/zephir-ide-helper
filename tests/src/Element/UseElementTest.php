<?php
namespace PruneMazui\ZephirIdeHelper\Element\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\Element\UseElement;
use PruneMazui\ZephirIdeHelper\DefinitionException;

class UseElementTest extends TestCase
{
    public function testSuccess()
    {
        $params = [
            'type' => 'use',
            'aliases' => [
                [
                    'name' => 'Exception',
                    'alias' => 'Ex'
                ],
                [
                    'name' => 'Exception'
                ]
            ]
        ];

        $use = UseElement::factory($params);
        assertCount(2, $use->getAliases());
    }

    public function testFailure()
    {
        try {
            UseElement::factory([
                'type' => 'hoge',
                'aliases' => [
                    [
                        'name' => 'Exception'
                    ]
                ]
            ]);
            $this->fail('excepted throw by miss match type.');
        } catch (DefinitionException $ex) {
            $this->addToAssertionCount(1);
        }

        try {
            UseElement::factory([
                'type' => 'use',
                'aliases' => [
                    [
                        'name' => ''
                    ]
                ]
            ]);
            $this->fail('excepted throw by not exist aliase name.');
        } catch (DefinitionException $ex) {
            $this->addToAssertionCount(1);
        }

        try {
            UseElement::factory([
                'type' => 'use',
                'aliases' => [],
            ]);
            $this->fail('excepted throw by not exist aliases.');
        } catch (DefinitionException $ex) {
            $this->addToAssertionCount(1);
        }
    }
}
