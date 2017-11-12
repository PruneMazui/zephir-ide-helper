<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;

class PropertyElement extends AbstractNamedElement implements EncodableInterface
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

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        return implode(' ', $this->visibility) . ' $' . $this->getName() . ";\n";
    }
}
