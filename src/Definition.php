<?php
namespace PruneMazui\ZephirIdeHelper;

use PruneMazui\ZephirIdeHelper\Element\NamespaceElement;
use PruneMazui\ZephirIdeHelper\Element\UseElement;
use PruneMazui\ZephirIdeHelper\Element\ClassElement;

class Definition
{
    const TYPE_NEXT_CLASS_COMMENT = 'comment';

    /**
     * @var NamespaceElement[]
     */
    private $namespaces = [];

    /**
     * @return \PruneMazui\ZephirIdeHelper\Element\NamespaceElement[]
     */
    public function getNamespaces()
    {
        return $this->namespaces;
    }

    /**
     * @param array $first_row
     * @return \PruneMazui\ZephirIdeHelper\Element\NamespaceElement
     */
    private function makeNamespace(array $first_row)
    {
        if ($first_row['type'] !== NamespaceElement::TYPE) {
            return NamespaceElement::factoryToplevelNamespace();
        }

        return NamespaceElement::factory($first_row);
    }

    /**
     * @param array $parse_result
     * @return self
     */
    public function reflectParse(array $parse_result): Definition
    {
        $namespace = $this->makeNamespace(current($parse_result));
        $comment = '';

        foreach ($parse_result as $row) {
            switch ($row['type']) {
                case NamespaceElement::TYPE:
                    break;

                case UseElement::TYPE:
                    $namespace->addUse(UseElement::factory($row));
                    break;

                case ClassElement::TYPE:
                    $namespace->addClass(ClassElement::factory($row, $comment));
                    break;

                case self::TYPE_NEXT_CLASS_COMMENT:
                    $comment = $row['value'];
                    break;

                case NamespaceElement::TYPE:
                default:
                    break;
            }

        }

        $this->namespaces[] = $namespace;

        return $this;
    }
}
