<?php
namespace PruneMazui\ZephirIdeHelper\Element;

trait TraitPHPDocGenerator
{
    public function generatorPHPDoc(PHPDocSupportInterface $element)
    {
        $origin = $element->getComment();
        if (empty($origin)) {
            $origin = '';
        }

        $annotation = [];
        $comment = [];

        foreach (explode("\n", $origin) as $line) {
            $line = trim($line, "* \t\n\r\0\x0B");

            if (! strlen($line)) {
                continue;
            }

            if (preg_match('/^@/', $line)) {
                $annotation[] = $line;
            } else {
                $comment[] = $line;
            }
        }

        $hasStartWith = function ($actual) use ($annotation) {
            foreach ($annotation as $target) {
                if (strpos($target, $actual) === 0) {
                    return true;
                }
            }

            return false;
        };

        if ($element->isAbstract() && !$hasStartWith('@abstract')) {
            $annotation[] = '@abstract';
        }

        if ($element->isDeprecated() && !$hasStartWith('@deprecated')) {
            $annotation[] = '@deprecated';
        }

        if ($element->isFinal() && !$hasStartWith('@final')) {
            $annotation[] = '@final';
        }

        if ($element->isStatic() && !$hasStartWith('@static')) {
            $annotation[] = '@static';
        }

        if (! array_filter($annotation) && ! array_filter($comment)) {
            return "";
        }

        $ret = "/**\n";

        foreach ($comment as $line) {
            $ret .= " * {$line}\n";
        }

        if (count($comment) && count($annotation)) {
            $ret .= " *\n";
        }

        foreach ($annotation as $line) {
            $ret .= " * {$line}\n";
        }

        return $ret . " */";
    }
}
