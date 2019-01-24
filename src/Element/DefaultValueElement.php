<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;

class DefaultValueElement implements EncodableInterface
{
    private static $escapeMap = [
        '\\' => '\\\\',
        "'"  => "\\'"
    ];

    /**
     * @var string
     */
    private $type = 'null';

    /**
     * @var mixed
     */
    private $value = null;

    /**
     * @var self[]
     */
    private $children = [];

    private function escape($str)
    {
        return str_replace(array_keys(self::$escapeMap), array_values(self::$escapeMap), $str);
    }

    /**
     * @param array $params
     * @return self
     */
    public static function factory(array $params): self
    {
        $ret = new self();

        $ret->type = $params['type'] ?? 'null';

        if ($ret->type != 'array') {
            $ret->value = $params['value'] ?? null;
            return $ret;
        }

        $children = $params['left'] ?? [];

        foreach ($children as $child) {
            $ret->children[] = self::factory($child['value']);
        }

        return $ret;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        switch ($this->type) {
            case 'null':
                return 'null';

            case 'empty-array':
                return '[]';

            case 'int':
            case 'double':
                return "{$this->value}";

            case 'array':
                $row = [];
                foreach ($this->children as $child) {
                    $row[] = $child->encode();
                }
                return '[' . implode(', ', $row) . ']';

            case 'bool':
                return $this->value === 'true' ? "true" : "false";
            case 'string':
            default:
                return "'{$this->escape($this->value)}'";
        }
    }
}
