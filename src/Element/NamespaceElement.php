<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;
use PruneMazui\ZephirIdeHelper\Util;
use PruneMazui\ZephirIdeHelper\DefinitionException;

class NamespaceElement extends AbstractNamedElement implements EncodableInterface
{
    const TYPE = 'namespace';

    /**
     * @var ClassElement[]
     */
    private $classes = [];

    /**
     * @var UseElement[]
     */
    private $uses = [];

    /**
     * @param array $param
     * @throws DefinitionException
     * @return self
     */
    public static function factory(array $params): self
    {
        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new DefinitionException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $name = $params['name'] ?? '';
        if (! strlen($name)) {
            return self::factoryToplevelNamespace();
        }

        $ret = new self();
        $ret->name = $name;
        return $ret;
    }

    /**
     * @return self
     */
    public static function factoryToplevelNamespace(): self
    {
        $ret = new self();
        $ret->name = '';
        return $ret;
    }

    /**
     * @return bool
     */
    public function hasClass(): bool
    {
        return !! $this->countClass();
    }

    /**
     * @return int
     */
    public function countClass(): int
    {
        return count($this->getClasses());
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\ClassElement[]
     */
    public function getClasses()
    {
        return $this->classes;
    }

    /**
     * @param ClassElement $class
     * @return \PruneMazui\ZephirIdeHelper\Element\NamespaceElement
     */
    public function addClass(ClassElement $class)
    {
        $this->classes[] = $class;
        return $this;
    }

    /**
     * @return bool
     */
    public function hasUse(): bool
    {
        return !! $this->countUse();
    }

    /**
     * @return int
     */
    public function countUse(): int
    {
        return count($this->getUses());
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\UseElement[]
     */
    public function getUses()
    {
        return $this->uses;
    }

    /**
     * @param UseElement $use
     * @return self
     */
    public function addUse(UseElement $use): self
    {
        $this->uses[] = $use;
        return $this;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        $content = 'namespace ' . $this->getName() . "\n{\n";

        foreach ($this->uses as $use) {
            $content .= Util::indent($use->encode());
        }

        $content .= "\n";

        foreach ($this->classes as $class) {
            $content .= Util::indent($class->encode()) . "\n";
        }

        $content.= "}\n";

        return $content;
    }
}
