<?php
namespace PruneMazui\ZephirIdeHelper\Element;

use PruneMazui\ZephirIdeHelper\EncodableInterface;
use PruneMazui\ZephirIdeHelper\Util;
use PruneMazui\ZephirIdeHelper\DefinitionException;

class MethodElement extends AbstractNamedElement implements EncodableInterface, PHPDocSupportInterface
{
    use TraitPHPDocGenerator;

    const TYPE = 'method';

    /**
     * @var bool
     */
    private $isPublic = true;

    /**
     * @var bool
     */
    private $isFinal = false;

    /**
     * @var bool
     */
    private $isDeprecated = false;

    /**
     * @var bool
     */
    private $isStatic = false;

    /**
     * @var bool
     */
    private $isAbstract = false;

    /**
     * @var ArgumentElement[]
     */
    private $arguments = [];

    /**
     * @var string
     */
    private $comment = '';

    /**
     * @return bool
     */
    public function isPublic(): bool
    {
        return $this->isPublic;
    }

    /**
     * @return bool
     */
    public function isFinal(): bool
    {
        return $this->isFinal;
    }

    /**
     * @return bool
     */
    public function isDeprecated(): bool
    {
        return $this->isDeprecated;
    }

    /**
     * @return bool
     */
    public function isStatic(): bool
    {
        return $this->isStatic;
    }

    /**
     * @return bool
     */
    public function isAbstract(): bool
    {
        return $this->isAbstract;
    }

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\ArgumentElement[]
     */
    public function getArguments(): array
    {
        return $this->arguments;
    }

    /**
     * @return boolean
     */
    public function hasArgument(): bool
    {
        return !! count($this->getArguments());
    }

    /**
     * @return string
     */
    public function getComment(): string
    {
        return $this->comment;
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

        $visibility = $params['visibility'] ?? [];
        $ret->isPublic = in_array('public', $visibility);
        $ret->isStatic = in_array('static', $visibility);
        $ret->isFinal = in_array('final', $visibility);
        $ret->isAbstract = in_array('abstract', $visibility);
        $ret->isDeprecated = in_array('deprecated', $visibility);

        $parameters = $params['parameters'] ?? [];
        foreach ($parameters as $parameter) {
            $ret->arguments[] = ArgumentElement::factory($parameter);
        }

        $ret->comment = $params['docblock'] ?? '';

        return $ret;
    }

    /**
     * @param array $params
     * @throws DefinitionException
     * @return self[]
     */
    public static function factoryAllPropertyShortCuts(array $params): array
    {
        $type = $params['type'] ?? '';
        if ($type !== PropertyElement::TYPE) {
            throw new DefinitionException('Not match type ' . self::TYPE . ' AND ' . $type . '.');
        }

        $shortcuts = $params['shortcuts'] ?? [];
        if (! count($shortcuts)) {
            return [];
        }

        $ret = [];

        $name = $params['name'] ?? '';
        if (! strlen($name)) {
            throw new DefinitionException('property name is required.');
        }
        $name_camelized = Util::camelize($name);

        foreach ($shortcuts as $shortcut) {
            switch ($shortcut['name'] ?? '') {
                case 'get':
                    $elem = new self();
                    $elem->name = 'get' . $name_camelized;
                    $ret[] = $elem;
                    break;

                case 'set':
                    $elem = new self();
                    $elem->name = 'set' . $name_camelized;
                    $elem->arguments[] = ArgumentElement::factory($name);
                    $ret[] = $elem;
                    break;

                case 'toString':
                    $elem = new self();
                    $elem->name = '__toString';
                    $ret[] = $elem;
                    break;
            }
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

        if ($this->isPublic) {
            $content .= 'public ';
        } else {
            $content .= 'protected ';
        }

        if ($this->isStatic) {
            $content .= 'static ';
        }

        $content .= 'function ' . $this->getName() . "(";

        $argment = [];
        foreach ($this->arguments as $argument) {
            $argment[] = $argument->encode();
        }
        $content .= implode(', ', $argment);
        $content .= ")\n{" . "}\n";

        return $content;
    }
}
