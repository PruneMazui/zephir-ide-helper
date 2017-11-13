<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;

class ConstantElement extends AbstractNamedElement implements EncodableInterface
{
    const TYPE = 'const';

    /**
     * @var DefaultValueElement
     */
    private $defaultValue;

    /**
     * @return bool
     */
    public function hasDefaultValue(): bool
    {
        return $this->defaultValue instanceof DefaultValueElement;
    }

    /**
     * @return DefaultValueElement
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

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

        $ret->defaultValue = DefaultValueElement::factory($params['default']);

        return $ret;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        // @todo see type
        return 'const ' . $this->getName() . ' = ' . $this->defaultValue->encode() . ";\n";
    }
}
