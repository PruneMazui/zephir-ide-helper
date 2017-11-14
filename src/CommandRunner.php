<?php
namespace PruneMazui\ZephirIdeHelper;

class CommandRunner
{
    private static $argmentMap = [
        'file' => ['-f', '--file']
    ];

    private $executedScriptName;

    private $file = '__zephir_ide_helper.php';

    private $target = '';

    /**
     * Handle operation
     * @return void
     */
    public static function exec(): bool
    {
        return (new static())->run($_SERVER['argv']);
    }

    public function run(array $arg): bool
    {
        $this->executedScriptName = array_shift($arg);

        $option = null;
        foreach ($arg as $key => $val) {

            // set next argument
            if (!is_null($option)) {

                $this->$option = $val;
                unset($arg[$key]);

                $option = null;
                continue;
            }


            foreach (self::$argmentMap as $property => $keywords) {
                if (in_array($val, $keywords)) {
                    unset($arg[$key]);
                    $option = $property;
                    break;
                }
            }
        }

        foreach ($arg as $val) {
            if (strpos($val, '-') === 0) {
                $this->showHelp('Unknown option: ' . $val);
                return false;
            }
        }

        if (! count($arg)) {
            $this->showHelp();
            return false;
        }

        $this->target .= end($arg);

        if (! file_exists($this->target)) {
            $this->showHelp('Target file is not found.');
            return false;
        }

        $parser = new Parser();

        $parser->add($this->target);

        if (! count($parser->getFiles())) {
            $this->showHelp('Target file is not found.');
            return false;
        }

        $definition = new Definition();
        foreach ($parser->getParseResultGenerator() as $result) {
            $definition->reflectParse($result);
        }

        if (file_put_contents($this->file, $definition->encode())) {

            return true;
        }

        echo "Failed to write php file.";
        return false;
    }

    private function showHelp(string $prefix = '')
    {
        $content = $prefix . <<< EOC

Usage: {$this->executedScriptName} [-option] target
    Specify the target file(.zep) or directory(recursive analayze the file) to be analyzed

    -f, --file  Export php file name. (Default: __zephir_ide_helper.php)
EOC;

        echo trim($content);
    }
}
