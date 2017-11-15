<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;
use PruneMazui\ZephirIdeHelper\DefinitionException;

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
     * @throws DefinitionException
     * @return self
     */
    public static function factory(array $param): self
    {
        $type = $param['type'] ?? '';

        if ($type !== self::TYPE) {
            throw new DefinitionException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $ret = new self();
        $aliases = $param['aliases'] ?? [];

        foreach ($aliases as $aliase) {
            if (empty($aliase['name'])) {
                throw new DefinitionException('aliase name is required.');
            }

            $content = $aliase['name'];

            if (! empty($aliase['alias'])) {
                $content .= ' as ' . $aliase['alias'];
            }

            $ret->aliases[] = $content;
        }

        if (empty($ret->aliases)) {
            throw new DefinitionException('Aliases is empty.');
        }

        return $ret;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        return 'use ' . implode(', ', $this->getAliases()) . ";\n";
    }
}
