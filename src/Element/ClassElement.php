<?php
namespace PruneMazui\ZephirIdeHelper\Element;


class ClassElement extends AbstractNamedElement
{
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
            throw new \RuntimeException('class name is required.');
        }

        $ret->isAbstract = $params['abstract'] ?? false;
        $ret->isFinal = $params['final'] ?? false;

        $ret->extends = $params['extends'];

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
}
