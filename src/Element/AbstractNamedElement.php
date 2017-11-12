<?php
namespace PruneMazui\ZephirIdeHelper\Element;

abstract class AbstractNamedElement implements NamedInterface
{
    /**
     * @var string
     */
    protected $name = '';

    /**
     * {@inheritDoc}
     * @see \PruneMazui\ZephirIdeHelper\Element\NamedInterface::getName()
     */
    public function getName(): string
    {
        return $this->name;
    }
}
