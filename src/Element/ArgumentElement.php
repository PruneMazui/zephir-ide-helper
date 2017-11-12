<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;

class ArgumentElement extends AbstractNamedElement implements EncodableInterface
{
    const TYPE = 'parameter';

    private static $excludeDataTypeMap = [
        'variable'
    ];

    private $hasDefault = false;

    private $defaultType = null;

    private $defaultValue = null;

    private $dataType = null;

    /**
     * @return boolean
     */
    public function hasDefault(): bool
    {
        return $this->hasDefault;
    }

    /**
     * @return string
     */
    public function getDefaultType(): string
    {
        return $this->defaultType;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @return string | null
     */
    public function getDataType()
    {
        return $this->dataType;
    }

    /**
     *
     * @param array | string $params
     * @return self
     */
    public static function factory($params): self
    {
        $ret = new self();

        if (is_string($params)) {
            $ret->name = $params;
            return $ret;
        }

        if (! is_array($params)) {
            throw new \LogicException('invalid argument');
        }

        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new \LogicException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $data_type = $params['data-type'] ?? null;
        if (! in_array($data_type, self::$excludeDataTypeMap)) {
            $ret->dataType = $data_type;
        }

        $ret->name = $params['name'] ?? '';
        if (! strlen($ret->name)) {
            throw new \RuntimeException('parameter name is required.');
        }

        if (! isset($params['default'])) {
            return $ret;
        }

        $ret->hasDefault = true;
        $ret->defaultType = $params['default']['type'];
        $ret->defaultValue = $params['default']['value'] ?? null;

        return $ret;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        $content = '';

        if ($this->dataType) {
            $content .= $this->dataType . ' ';
        }

        $content .= '$' . $this->getName();

        if ($this->hasDefault) {
            // @todo
        }

        return $content;
    }
}
