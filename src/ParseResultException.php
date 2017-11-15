<?php
namespace PruneMazui\ZephirIdeHelper;

class ParseResultException extends \RuntimeException
{
    const TYPE = 'error';

    /**
     * @param array $params
     * @throws \RuntimeException
     * @return self
     */
    public static function factory(array $params): self
    {
        $type = $params['type'] ?? '';
        if ($type !== self::TYPE) {
            throw new \RuntimeException('Unknown parse error occured.');
        }

        $messege = $params['message'] ?? '';

        if (isset ($params['file'])) {
            $message .= ' : ' . $params['file'];
        }

        if (isset ($params['line'])) {
            $message .= '(line: ' . $params['line'] . ')';
        }

        return new self($message);
    }
}
