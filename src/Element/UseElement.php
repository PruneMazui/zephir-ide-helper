<?php
namespace PruneMazui\ZephirIdeHelper\Element;

class UseElement
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

            $ret->aliases[] = $aliase['name'];
        }

        return $ret;
    }
}
