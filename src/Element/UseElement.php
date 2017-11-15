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
     * @var string[]
     */
    private $uniqueNames = [];

    private $excludeConflictMap = [];

    /**
     * @param array $exclude_conflict_map
     * @return self
     */
    public function setExcludeConflictMap(array $exclude_conflict_map): self
    {
        $this->excludeConflictMap = $exclude_conflict_map;
        return $this;
    }

    /**
     * @return string[]
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    /**
     * @var string[]
     */
    public function getUniqueNames(): array
    {
        return $this->uniqueNames;
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
            $unique_name = end(explode('\\', $aliase['name']));

            if (! empty($aliase['alias'])) {
                $content .= ' as ' . $aliase['alias'];
                $unique_name = $aliase['alias'];
            }

            $ret->aliases[] = $content;
            $ret->uniqueNames[] = $unique_name;
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
        $aliases = $this->getAliases();

        foreach ($this->uniqueNames as $key => $unique_name) {
            if (in_array($unique_name, $this->excludeConflictMap)) {
                unset($aliases[$key]);
            }
        }


        if (! count($aliases)) {
            return '';
        }

        return 'use ' . implode(', ', $aliases) . ";\n";
    }
}
