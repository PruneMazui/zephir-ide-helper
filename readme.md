zephir-ide-helper
===

[![Build Status](https://travis-ci.org/PruneMazui/zephir-ide-helper.svg?branch=master)](https://travis-ci.org/PruneMazui/zephir-ide-helper)
[![Coverage Status](https://coveralls.io/repos/github/PruneMazui/zephir-ide-helper/badge.svg?branch=master)](https://coveralls.io/github/PruneMazui/zephir-ide-helper?branch=master)

Generate php code completion file from zephir file(.zep).

The code completion file is valid in the IDE (ex. PHPStorm).


## Example

Zephir Code

```
namespace PruneMazui\ZephirSample;

/**
 * Sample class Greeting
 */
class Greeting
{
    protected message = "hello world" { set, toString };

    /**
     * constructor
     *
     * @param string optional message
     */
    public function __construct(string message = null)
    {
        if message !== null {
            let this->message = message;
        }
    }

    /**
     * Output Message to stdout
     */
    public function say()
    {
        echo this->message;
    }
}
```

Generate PHP Code

```
<?php
namespace PruneMazui\ZephirSample
{
    /**
     * Sample class Greeting
     */
    class Greeting
    {
        protected $message;

        public function setMessage($message)
        {}

        public function __toString()
        {}

        /**
         * constructor
         *
         * @param string optional message
         */
        public function __construct(string $message = null)
        {}

        /**
         * Output Message to stdout
         */
        public function say()
        {}
    }
}
```

## Requirements

* PHP >= 7.0
* [Zephir Parser](https://github.com/phalcon/php-zephir-parser) >= 1.1.0

## Installation

```
composer require prune-mazui/zephir-ide-helper
```

## Usage

```
vendor/bin/zephir-ide-helper [-option] target
```

### Arguments

#### target

Specify the Zephir file or directory.  
If you specify a directory, read the directory recursively and look for the Zephir file.  

#### -option

* `-f`(`--file`) ... Specify the PHP file name to output(Default: \_\_zephir\_ide\_helper.php).


## Licence

MIT

