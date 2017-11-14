<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;
use PruneMazui\ZephirIdeHelper\Util;

class InterfaceElement extends AbstractNamedElement implements EncodableInterface, PHPDocSupportInterface
{
    use TraitPHPDocGenerator;

    const TYPE = 'interface';

    /**
     * @var string
     */
    private $comment = '';

    /**
     * @var MethodElement[]
     */
    private $methods = [];

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
    }

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
     * @return \PruneMazui\ZephirIdeHelper\Element\MethodElement[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $params
     * @param string $comment
     * @throws DefinitionException
     * @return self
     */
    public static function factory(array $params, string $comment): self
    {
        $ret = new self();

        $ret->comment = $comment;

        $ret->name = $params['name'] ?? '';
        if (! strlen($ret->name)) {
            throw new DefinitionException('class name is required.');
        }

        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new DefinitionException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        // methods
        $methods = $params['definition']['methods'] ?? [];
        foreach ($methods as $method) {
            $ret->methods[] = MethodElement::factory($method, true);
        }

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

        $content .= 'interface ' . $this->getName() . ' ';

        $content .= "\n{\n";

        foreach ($this->methods as $method) {
            $content .= Util::indent($method->encode() . "\n");
        }

        $content .= "}\n";

        return $content;
    }
}
