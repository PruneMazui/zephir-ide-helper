<?php
return array (
  0 => 
  array (
    'type' => 'namespace',
    'name' => 'PruneMazui\\Zephir\\Utils',
    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
    'line' => 3,
    'char' => 3,
  ),
  1 => 
  array (
    'type' => 'use',
    'aliases' => 
    array (
      0 => 
      array (
        'name' => 'Exception',
        'alias' => 'Ex',
        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
        'line' => 3,
        'char' => 20,
      ),
      1 => 
      array (
        'name' => 'Exception',
        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
        'line' => 3,
        'char' => 31,
      ),
    ),
    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
    'line' => 4,
    'char' => 3,
  ),
  2 => 
  array (
    'type' => 'use',
    'aliases' => 
    array (
      0 => 
      array (
        'name' => 'SplFileObject',
        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
        'line' => 4,
        'char' => 18,
      ),
    ),
    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
    'line' => 8,
    'char' => 2,
  ),
  3 => 
  array (
    'type' => 'comment',
    'value' => '**
 * Sample class Greeting
 *',
    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
    'line' => 9,
    'char' => 5,
  ),
  4 => 
  array (
    'type' => 'class',
    'name' => 'Greeting',
    'abstract' => 0,
    'final' => 0,
    'definition' => 
    array (
      'properties' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
            1 => 'static',
          ),
          'type' => 'property',
          'name' => 'static_message',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'hello world',
            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
            'line' => 19,
            'char' => 54,
          ),
          'docblock' => '**
     * @var string
     *',
          'shortcuts' => 
          array (
            0 => 
            array (
              'type' => 'shortcut',
              'name' => 'get',
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 19,
              'char' => 60,
            ),
          ),
          'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
          'line' => 23,
          'char' => 6,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'protected',
          ),
          'type' => 'property',
          'name' => 'message',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'hello world',
            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
            'line' => 24,
            'char' => 39,
          ),
          'docblock' => '**
     * @var string
     *',
          'shortcuts' => 
          array (
            0 => 
            array (
              'type' => 'shortcut',
              'name' => 'get',
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 24,
              'char' => 44,
            ),
            1 => 
            array (
              'type' => 'shortcut',
              'name' => 'set',
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 24,
              'char' => 49,
            ),
            2 => 
            array (
              'type' => 'shortcut',
              'name' => 'toString',
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 24,
              'char' => 60,
            ),
          ),
          'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
          'line' => 30,
          'char' => 6,
        ),
      ),
      'methods' => 
      array (
        0 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
          ),
          'type' => 'method',
          'name' => '__construct',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'message',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'null',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 31,
                'char' => 54,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 31,
              'char' => 54,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'hoge',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'string',
                'value' => '',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 31,
                'char' => 72,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 31,
              'char' => 72,
            ),
            2 => 
            array (
              'type' => 'parameter',
              'name' => 'fuga',
              'const' => 0,
              'data-type' => 'string',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'string',
                'value' => 'null',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 31,
                'char' => 94,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 31,
              'char' => 94,
            ),
            3 => 
            array (
              'type' => 'parameter',
              'name' => 'piyo',
              'const' => 0,
              'data-type' => 'array',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'empty-array',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 31,
                'char' => 111,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 31,
              'char' => 111,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'if',
              'expr' => 
              array (
                'type' => 'not-identical',
                'left' => 
                array (
                  'type' => 'variable',
                  'value' => 'message',
                  'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                  'line' => 33,
                  'char' => 22,
                ),
                'right' => 
                array (
                  'type' => 'null',
                  'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                  'line' => 33,
                  'char' => 29,
                ),
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 33,
                'char' => 29,
              ),
              'statements' => 
              array (
                0 => 
                array (
                  'type' => 'let',
                  'assignments' => 
                  array (
                    0 => 
                    array (
                      'assign-type' => 'object-property',
                      'operator' => 'assign',
                      'variable' => 'this',
                      'property' => 'message',
                      'expr' => 
                      array (
                        'type' => 'variable',
                        'value' => 'message',
                        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                        'line' => 34,
                        'char' => 40,
                      ),
                      'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                      'line' => 34,
                      'char' => 40,
                    ),
                  ),
                  'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                  'line' => 35,
                  'char' => 9,
                ),
              ),
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 36,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * constructor
     *
     * @param string optional message
     *',
          'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
          'line' => 31,
          'last-line' => 42,
          'char' => 19,
        ),
        1 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
            1 => 'static',
          ),
          'type' => 'method',
          'name' => 'say',
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'echo',
              'expressions' => 
              array (
                0 => 
                array (
                  'type' => 'string',
                  'value' => 'hello world!',
                  'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                  'line' => 45,
                  'char' => 28,
                ),
              ),
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 46,
              'char' => 5,
            ),
          ),
          'docblock' => '**
     * Output "hello zephir world" to STDOUT
     *
     * @return void
     *',
          'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
          'line' => 43,
          'last-line' => 48,
          'char' => 26,
        ),
        2 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
            1 => 'final',
            2 => 'deprecated',
          ),
          'type' => 'method',
          'name' => 'deprecatedFunction',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'piyo',
              'const' => 0,
              'data-type' => 'int',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'int',
                'value' => '1',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 48,
                'char' => 69,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 48,
              'char' => 69,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'echo',
              'expressions' => 
              array (
                0 => 
                array (
                  'type' => 'string',
                  'value' => 'old',
                  'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                  'line' => 50,
                  'char' => 19,
                ),
              ),
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 51,
              'char' => 5,
            ),
          ),
          'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
          'line' => 48,
          'last-line' => 53,
          'char' => 36,
        ),
        3 => 
        array (
          'visibility' => 
          array (
            0 => 'public',
            1 => 'final',
            2 => 'deprecated',
          ),
          'type' => 'method',
          'name' => 'pipipi',
          'parameters' => 
          array (
            0 => 
            array (
              'type' => 'parameter',
              'name' => 'piyo',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'double',
                'value' => '1.2',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 53,
                'char' => 55,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 53,
              'char' => 55,
            ),
            1 => 
            array (
              'type' => 'parameter',
              'name' => 'fuga',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'array',
                'left' => 
                array (
                  0 => 
                  array (
                    'value' => 
                    array (
                      'type' => 'int',
                      'value' => '1',
                      'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                      'line' => 53,
                      'char' => 64,
                    ),
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 53,
                    'char' => 64,
                  ),
                  1 => 
                  array (
                    'value' => 
                    array (
                      'type' => 'int',
                      'value' => '2',
                      'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                      'line' => 53,
                      'char' => 67,
                    ),
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 53,
                    'char' => 67,
                  ),
                  2 => 
                  array (
                    'value' => 
                    array (
                      'type' => 'int',
                      'value' => '3',
                      'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                      'line' => 53,
                      'char' => 70,
                    ),
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 53,
                    'char' => 70,
                  ),
                ),
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 53,
                'char' => 71,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 53,
              'char' => 71,
            ),
            2 => 
            array (
              'type' => 'parameter',
              'name' => 'hoge',
              'const' => 0,
              'data-type' => 'variable',
              'mandatory' => 0,
              'default' => 
              array (
                'type' => 'string',
                'value' => '\'\'\'',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 53,
                'char' => 85,
              ),
              'reference' => 0,
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 53,
              'char' => 85,
            ),
          ),
          'statements' => 
          array (
            0 => 
            array (
              'type' => 'echo',
              'expressions' => 
              array (
                0 => 
                array (
                  'type' => 'string',
                  'value' => 'old',
                  'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                  'line' => 55,
                  'char' => 19,
                ),
              ),
              'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
              'line' => 56,
              'char' => 5,
            ),
          ),
          'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
          'line' => 53,
          'last-line' => 57,
          'char' => 36,
        ),
      ),
      'constants' => 
      array (
        0 => 
        array (
          'type' => 'const',
          'name' => 'CONSTANT_TEXT',
          'default' => 
          array (
            'type' => 'string',
            'value' => 'aaaaa',
            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
            'line' => 14,
            'char' => 34,
          ),
          'docblock' => '**
     * hogege
     *',
          'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
          'line' => 18,
          'char' => 6,
        ),
      ),
      'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
      'line' => 9,
      'char' => 5,
    ),
    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
    'line' => 9,
    'char' => 5,
  ),
);
