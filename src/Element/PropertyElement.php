<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;

class PropertyElement extends AbstractNamedElement implements EncodableInterface, PHPDocSupportInterface
{
    use TraitPHPDocGenerator;

    const TYPE = 'property';

    private $visibility = [];

    private $comment = '';

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isDeprecated()
     */
    public function isDeprecated(): bool
    {
        return in_array('deprecated', $this->visibility);
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isStatic()
     */
    public function isStatic(): bool
    {
        return in_array('static', $this->visibility);
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::getComment()
     */
    public function getComment(): string
    {
        return $this->comment;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isFinal()
     */
    public function isFinal(): bool
    {
        return in_array('final', $this->visibility);
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isAbstract()
     */
    public function isAbstract(): bool
    {
        return in_array('abstract', $this->visibility);
    }

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
        $ret->comment = $params['docblock'] ?? '';

        return $ret;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\EncodableInterface::encode()
     */
    public function encode(): string
    {
        $content = $this->generatorPHPDoc($this);

        if (strlen($content)) {
            $content .= "\n";
        }

        return $content . implode(' ', $this->visibility) . ' $' . $this->getName() . ";\n";
    }
}
