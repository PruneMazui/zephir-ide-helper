<?php
namespace PruneMazui\ZephirIdeHelper\Element\Tests;

use PruneMazui\ZephirIdeHelper\Element\NamespaceElement;
use PHPUnit\Framework\TestCase;

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
    }
}
