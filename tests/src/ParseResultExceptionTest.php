<?php
namespace PruneMazui\ZephirIdeHelper\Tests;

use PHPUnit\Framework\TestCase;
use PruneMazui\ZephirIdeHelper\ParseResultException;

class ParseResultExceptionTest extends TestCase
{
    public function testFactory()
    {
        assertInstanceOf(ParseResultException::class, ParseResultException::factory([
            'type' => 'error',
            'message' => 'test'
        ]));

        try {
            ParseResultException::factory([
                'type' => 'hoge',
                'message' => 'test'
            ]);

            $this->fail();
        } catch (\RuntimeException $ex) {
            $this->addToAssertionCount(1);
        }
    }

}
