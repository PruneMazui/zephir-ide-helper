<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;

class UseElement implements EncodableInterface
{
    const TYPE = 'use';

    /**
     * @var string[]
     */
    private $aliases = [];

    /**
     * @return string[]
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @param array $param
     * @throws \LogicException
     * @return self
     */
    public static function factory(array $param): self
    {
        $type = $param['type'] ?? '';

        if ($type !== self::TYPE) {
            throw new \LogicException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $ret = new self();
        $aliases = $param['aliases'] ?? [];

        foreach ($aliases as $aliase) {
            if (empty($aliase['name'])) {
                continue;
            }

            $content = $aliase['name'];

            if (! empty($aliase['alias'])) {
                $content .= ' as ' . $aliase['alias'];
            }

            $ret->aliases[] = $content;
        }

        return $ret;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        return 'use ' . implode(', ', $this->aliases) . ";\n";
    }
}
