<?php
namespace PruneMazui\ZephirIdeHelper\Element;

class ConstantElement extends AbstractNamedElement
{
    const TYPE = 'const';

    private $value_type = '';

    private $value = '';

    /**
     * @param array $params
     * @throws \RuntimeException
     * @throws \LogicException
     * @return self
     */
    public static function factory(array $params): self
    {
        $ret = new self();

        $ret->name = $params['name'] ?? '';
        if (! strlen($ret->name)) {
            throw new \RuntimeException('method name is required.');
        }

        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new \LogicException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $ret->value_type = $params['default']['type'];
        $ret->value = $params['default']['value'];

        return $ret;
    }
}
