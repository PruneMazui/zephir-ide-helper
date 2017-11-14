<?php
namespace PruneMazui\ZephirIdeHelper\Element\Tests;

use PruneMazui\ZephirIdeHelper\Element\NamespaceElement;
use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\DefinitionException;

class NamespaceElementTest extends TestCase
{
    public function testSuccess()
    {
        $params = [
            'type' => 'namespace',
            'name' => 'Phalcon'
        ];

        $namespace = NamespaceElement::factory($params);

        assertEquals($params['name'], $namespace->getName());
        assertFalse($namespace->hasClass());
        assertFalse($namespace->hasUse());

        // --------------------------------------

        $namespace = NamespaceElement::factory([
            'type' => 'namespace',
            'name' => '',
        ]);

        assertEmpty($namespace->getName());
        assertFalse($namespace->hasClass());
        assertFalse($namespace->hasUse());
    }

    public function testFailure()
    {
        try {
            NamespaceElement::factory([
                'type' => 'not_namespace',
                'name' => 'fuga',
            ]);
            $this->fail('excepted throw by miss match type.');
        } catch (DefinitionException $ex) {
            $this->addToAssertionCount(1);
        }
    }
}
