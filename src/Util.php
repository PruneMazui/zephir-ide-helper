<?php
namespace PruneMazui\ZephirIdeHelper;

class Util
{
    const INDENT_STR = '    ';

    /**
     * @param       string $str
     * @return      string
     */
    public static function camelize(string $str): string
    {
        return str_replace(' ', '', ucwords(str_replace('_', ' ', $str)));
    }

    /**
     * @param string $str
     * @return string
     */
    public static function indent(string $str)
    {
        $ret = [];

        foreach (explode("\n", $str) as $word) {
            if (strlen($word)) {
                $word = self::INDENT_STR . $word;
            }

            $ret[] = $word;
        }

        return implode("\n", $ret);
    }
}