<?php
namespace PruneMazui\ZephirIdeHelper\Element;

interface PHPDocSupportInterface
{
    /**
     * return origin doc comment
     */
    public function getComment();

    public function isFinal(): bool;

    public function isDeprecated(): bool;

    public function isStatic(): bool;

    public function isAbstract(): bool;
}
