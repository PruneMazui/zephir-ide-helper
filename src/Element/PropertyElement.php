<?php
namespace PruneMazui\ZephirIdeHelper\Element;

class PropertyElement extends AbstractNamedElement
{
    const TYPE = 'property';

    private $visibility = [];

    /**
     * @param array $params
     * @return self | null
     */
    public static function factory(array $params)
    {
        $ret = new self();

        $ret->name = $params['name'] ?? '';
        if (! strlen($ret->name)) {
            throw new \RuntimeException('property name is required.');
        }

        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new \LogicException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $ret->visibility = $params['visibility'] ?? [];

        return $ret;
    }
}
