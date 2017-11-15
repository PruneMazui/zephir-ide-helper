<?php
namespace PruneMazui\ZephirIdeHelper;

class Parser
{
    private static $fileExtension = 'zep';

    /**
     * @var array
     */
    private $files;

    public function __construct()
    {
        $this->clearFiles();
    }

    /**
     * @return self
     */
    public function clearFiles()
    {
        $this->files = [];
        return $this;
    }

    public function getFiles()
    {
        return $this->files;
    }

    /**
     * @param string $path target File or directory
     * @return self
     */
    public function add(string $path)
    {
        if (! file_exists($path)) {
            return $this;
        }

        if (is_dir($path)) {
            foreach (new \DirectoryIterator($path) as $f) {
                if ($f->isDot()) {
                    continue;
                }

                $this->add($f->getRealPath());
            }

            return $this;
        }

        $file = new \SplFileObject($path);
        if ($file->getExtension() !== self::$fileExtension) {
            return $this;
        }

        $this->files[$file->getRealPath()] = $file->getRealPath();

        return $this;
    }

    /**
     * @param string $file
     * @return array
     */
    public function parse(string $file)
    {
        if (! function_exists('zephir_parse_file')) {
            throw new \RuntimeException('Function `zephir_parse_file` not found.');
        }

        return zephir_parse_file(file_get_contents($file), $file);
    }

    /**
     * @return \Generator
     */
    public function getParseResultGenerator(): \Generator
    {
        if (! count($this->files)) {
            return;
        }

        foreach ($this->files as $file) {
            yield realpath($file) => $this->parse($file);
        }
    }
}
