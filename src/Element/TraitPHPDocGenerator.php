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

        if ($element->isAbstract() && !in_array('@abstract', $annotation)) {
            $annotation[] = '@abstract';
        }

        if ($element->isDeprecated() && !in_array('@deprecated', $annotation)) {
            $annotation[] = '@deprecated';
        }

        if ($element->isFinal() && !in_array('@final', $annotation)) {
            $annotation[] = '@final';
        }

        if ($element->isStatic() && !in_array('@static', $annotation)) {
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
