<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;
use PruneMazui\ZephirIdeHelper\DefinitionException;

class ConstantElement extends AbstractNamedElement implements EncodableInterface, PHPDocSupportInterface
{
    use TraitPHPDocGenerator;

    const TYPE = 'const';

    /**
     * @var DefaultValueElement
     */
    private $defaultValue;

    /**
     * @var string
     */
    private $comment = '';

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isDeprecated()
     */
    public function isDeprecated(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isStatic()
     */
    public function isStatic(): bool
    {
        return false;
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
        return false;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isAbstract()
     */
    public function isAbstract(): bool
    {
        return false;
    }

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
     * @throws DefinitionException
     * @return self
     */
    public static function factory(array $params): self
    {
        $ret = new self();

        $ret->name = $params['name'] ?? '';
        if (! strlen($ret->name)) {
            throw new DefinitionException('method name is required.');
        }

        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new DefinitionException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $ret->defaultValue = DefaultValueElement::factory($params['default']);
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

        return $content . 'const ' . $this->getName() . ' = ' . $this->defaultValue->encode() . ";\n";
    }
}
