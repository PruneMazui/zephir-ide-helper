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
     *
     * @codeCoverageIgnore
     * @return void
     */
    public static function exec(): bool
    {
        return (new static())->run($_SERVER['argv']);
    }

    public function run(array $arg): bool
    {
        if (count($arg) == 0) {
            throw new \RuntimeException('illegal argument.');
        }

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

        try {
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
                $this->notify("The php file generated. \n" . realpath($this->file));
                return true;
            }

            $this->notify("Failed to write php file.");
            return false;

        } catch (DefinitionException $x) {
            $this->notify("Parse error occured. " . $ex->getMessage());
            return false;

        } catch (\Exception $ex) {
            $this->notify("Fatal error occured. " . $ex->getMessage());
            return false;
        }
    }

    private function showHelp(string $prefix = '')
    {
        $content = $prefix . <<< EOC


Usage: {$this->executedScriptName} [-option] target
    Specify the target file(.zep) or
        directory(recursive analayze the file) to be analyzed

    -f, --file  Export php file name. (Default: __zephir_ide_helper.php)
EOC;

        $this->notify(trim($content));
    }

    private function notify(string $content)
    {
        echo $content . "\n";
    }
}
