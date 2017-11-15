<?php
namespace PruneMazui\ZephirIdeHelper;

use Psr\Log\LoggerInterface;
use Psr\Log\AbstractLogger;

class CommandRunner
{
    private static $argmentMap = [
        'file' => ['-f', '--file']
    ];

    private $executedScriptName;

    private $file = '__zephir_ide_helper.php';

    private $target = '';

    /**
     * @var LoggerInterface
     */
    private $logger;

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

    /**
     * @param LoggerInterface optional $logger
     */
    public function __construct(LoggerInterface $logger = null)
    {
        if (! is_null($logger)) {
            $this->logger = $logger;
            return;
        }

        // logging stdout
        $this->logger = new class() extends AbstractLogger
        {
            public function log($level, $message, array $context = array())
            {
                fwrite(STDOUT, $message . "\n");
            }
        };
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

            $this->logger->debug("Process start");

            $definition = new Definition();
            foreach ($parser->getParseResultGenerator() as $file => $result) {
                try {
                    $this->logger->debug("Parsing ... {$file}");
                    $definition->reflectParse($result);
                } catch (ParseResultException $ex) {
                    $this->logger->warning($ex->getMessage());
                }
            }

            $this->logger->debug("Generating php code ...");
            if (file_put_contents($this->file, $definition->encode())) {
                $this->logger->info("The php file generated. \n" . realpath($this->file));
                return true;
            }

            $this->logger->error("Failed to write php file.");
            return false;

        } catch (DefinitionException $x) {
            $this->logger->error("Parse error occured. " . $ex->getMessage());
            return false;

        } catch (\Exception $ex) {
            $this->logger->error("Fatal error occured. " . $ex->getMessage());
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

        $this->logger->info(trim($content));
    }
}
