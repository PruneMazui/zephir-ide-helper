<?php
namespace PruneMazui\ZephirIdeHelper\Element;


use PruneMazui\ZephirIdeHelper\EncodableInterface;
use PruneMazui\ZephirIdeHelper\Util;
use PruneMazui\ZephirIdeHelper\DefinitionException;

class ClassElement extends AbstractNamedElement implements EncodableInterface, PHPDocSupportInterface
{
    use TraitPHPDocGenerator;

    const TYPE = 'class';

    /**
     * @var string
     */
    private $comment = '';

    /**
     * @var bool
     */
    private $isAbstract = false;

    /**
     * @var bool
     */
    private $isFinal = false;

    /**
     * @var string
     */
    private $extends = '';

    /**
     * @var string[]
     */
    private $implements = [];

    /**
     * @var MethodElement[]
     */
    private $methods = [];

    /**
     * @var PropertyElement[]
     */
    private $properties = [];

    /**
     * @var ConstantElement[]
     */
    private $constants = [];

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
        return $this->isFinal;
    }

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\PHPDocSupportInterface::isAbstract()
     */
    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\MethodElement[]
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\PropertyElement[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\ConstantElement[]
     */
    public function getConstants(): array
    {
        return $this->constants;
    }

    /**
     * @param array $params
     * @param string $comment
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

        $ret->isAbstract = $params['abstract'] ?? false;
        $ret->isFinal = $params['final'] ?? false;

        $ret->extends = $params['extends'] ?? '';

        $implements = $params['implements'] ?? [];
        foreach ($implements as $implement) {
            if (empty($implement['value'])) {
                continue;
            }

            $ret->implements[] = $implement['value'];
        }

        // properties
        $properties = $params['definition']['properties'] ?? [];
        foreach ($properties as $property) {
            $element = PropertyElement::factory($property);
            if ($element instanceof PropertyElement) {
                $ret->properties[] = $element;
            }

            $ret->methods = array_merge($ret->methods,
                MethodElement::factoryAllPropertyShortCuts($property));
        }

        // methods
        $methods = $params['definition']['methods'] ?? [];
        foreach ($methods as $method) {
            $ret->methods[] = MethodElement::factory($method);
        }

        // constant
        $constants = $params['definition']['constants'] ?? [];
        foreach ($constants as $constant) {
            $ret->constants[] = ConstantElement::factory($constant);
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

        if ($this->isAbstract) {
            $content .= 'abstract ';
        }

        if ($this->isFinal) {
            $content .= 'final ';
        }

        $content .= 'class ' . $this->getName() . ' ';

        if (strlen($this->extends)) {
            $content .= 'extends ' . $this->extends . ' ';
        }

        if (count($this->implements)) {
            $content .= 'implements ' . implode(', ', $this->implements) . ' ';
        }

        $content .= "\n{\n";

        foreach ($this->constants as $constant) {
            $content .= Util::indent($constant->encode() . "\n");
        }

        foreach ($this->properties as $property) {
            $content .= Util::indent($property->encode() . "\n");
        }

        foreach ($this->methods as $method) {
            $content .= Util::indent($method->encode() . "\n");
        }

        $content .= "}\n";

        return $content;
    }
}
