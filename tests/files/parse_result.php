<?php
return array(
    0 => array(
        'type' => 'namespace',
        'name' => 'PruneMazui\Zephir\Utils',
        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
        'line' => 3,
        'char' => 3
    ),
    1 => array(
        'type' => 'use',
        'aliases' => array(
            0 => array(
                'name' => 'Exception',
                'alias' => 'Ex',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 3,
                'char' => 20
            ),
            1 => array(
                'name' => 'Exception',
                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                'line' => 3,
                'char' => 31
            )
        ),
        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
        'line' => 7,
        'char' => 2
    ),
    2 => array(
        'type' => 'comment',
        'value' => '**
 * Sample class Greeting
 *',
        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
        'line' => 8,
        'char' => 5
    ),
    3 => array(
        'type' => 'class',
        'name' => 'Greeting',
        'abstract' => 0,
        'final' => 0,
        'definition' => array(
            'properties' => array(
                0 => array(
                    'visibility' => array(
                        0 => 'protected',
                        1 => 'static'
                    ),
                    'type' => 'property',
                    'name' => 'static_message',
                    'default' => array(
                        'type' => 'string',
                        'value' => 'hello world',
                        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                        'line' => 18,
                        'char' => 54
                    ),
                    'docblock' => '**
     * @var string
     *',
                    'shortcuts' => array(
                        0 => array(
                            'type' => 'shortcut',
                            'name' => 'get',
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 18,
                            'char' => 60
                        )
                    ),
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 22,
                    'char' => 6
                ),
                1 => array(
                    'visibility' => array(
                        0 => 'protected'
                    ),
                    'type' => 'property',
                    'name' => 'message',
                    'default' => array(
                        'type' => 'string',
                        'value' => 'hello world',
                        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                        'line' => 23,
                        'char' => 39
                    ),
                    'docblock' => '**
     * @var string
     *',
                    'shortcuts' => array(
                        0 => array(
                            'type' => 'shortcut',
                            'name' => 'get',
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 23,
                            'char' => 44
                        ),
                        1 => array(
                            'type' => 'shortcut',
                            'name' => 'set',
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 23,
                            'char' => 49
                        ),
                        2 => array(
                            'type' => 'shortcut',
                            'name' => 'toString',
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 23,
                            'char' => 60
                        )
                    ),
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 29,
                    'char' => 6
                )
            ),
            'methods' => array(
                0 => array(
                    'visibility' => array(
                        0 => 'public'
                    ),
                    'type' => 'method',
                    'name' => '__construct',
                    'parameters' => array(
                        0 => array(
                            'type' => 'parameter',
                            'name' => 'message',
                            'const' => 0,
                            'data-type' => 'string',
                            'mandatory' => 0,
                            'default' => array(
                                'type' => 'null',
                                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                'line' => 30,
                                'char' => 54
                            ),
                            'reference' => 0,
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 30,
                            'char' => 54
                        ),
                        1 => array(
                            'type' => 'parameter',
                            'name' => 'hoge',
                            'const' => 0,
                            'data-type' => 'string',
                            'mandatory' => 0,
                            'default' => array(
                                'type' => 'string',
                                'value' => '',
                                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                'line' => 30,
                                'char' => 72
                            ),
                            'reference' => 0,
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 30,
                            'char' => 72
                        ),
                        2 => array(
                            'type' => 'parameter',
                            'name' => 'fuga',
                            'const' => 0,
                            'data-type' => 'string',
                            'mandatory' => 0,
                            'default' => array(
                                'type' => 'string',
                                'value' => 'null',
                                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                'line' => 30,
                                'char' => 94
                            ),
                            'reference' => 0,
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 30,
                            'char' => 94
                        ),
                        3 => array(
                            'type' => 'parameter',
                            'name' => 'piyo',
                            'const' => 0,
                            'data-type' => 'array',
                            'mandatory' => 0,
                            'default' => array(
                                'type' => 'empty-array',
                                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                'line' => 30,
                                'char' => 111
                            ),
                            'reference' => 0,
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 30,
                            'char' => 111
                        )
                    ),
                    'statements' => array(
                        0 => array(
                            'type' => 'if',
                            'expr' => array(
                                'type' => 'not-identical',
                                'left' => array(
                                    'type' => 'variable',
                                    'value' => 'message',
                                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                    'line' => 32,
                                    'char' => 22
                                ),
                                'right' => array(
                                    'type' => 'null',
                                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                    'line' => 32,
                                    'char' => 29
                                ),
                                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                'line' => 32,
                                'char' => 29
                            ),
                            'statements' => array(
                                0 => array(
                                    'type' => 'let',
                                    'assignments' => array(
                                        0 => array(
                                            'assign-type' => 'object-property',
                                            'operator' => 'assign',
                                            'variable' => 'this',
                                            'property' => 'message',
                                            'expr' => array(
                                                'type' => 'variable',
                                                'value' => 'message',
                                                'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                                'line' => 33,
                                                'char' => 40
                                            ),
                                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                            'line' => 33,
                                            'char' => 40
                                        )
                                    ),
                                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                    'line' => 34,
                                    'char' => 9
                                )
                            ),
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 35,
                            'char' => 5
                        )
                    ),
                    'docblock' => '**
     * constructor
     *
     * @param string optional message
     *',
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 30,
                    'last-line' => 41,
                    'char' => 19
                ),
                1 => array(
                    'visibility' => array(
                        0 => 'public',
                        1 => 'static'
                    ),
                    'type' => 'method',
                    'name' => 'say',
                    'statements' => array(
                        0 => array(
                            'type' => 'echo',
                            'expressions' => array(
                                0 => array(
                                    'type' => 'string',
                                    'value' => 'hello world!',
                                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                    'line' => 44,
                                    'char' => 28
                                )
                            ),
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 45,
                            'char' => 5
                        )
                    ),
                    'docblock' => '**
     * Output "hello zephir world" to STDOUT
     *
     * @return void
     *',
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 42,
                    'last-line' => 47,
                    'char' => 26
                ),
                2 => array(
                    'visibility' => array(
                        0 => 'public',
                        1 => 'final',
                        2 => 'deprecated'
                    ),
                    'type' => 'method',
                    'name' => 'deprecatedFunction',
                    'statements' => array(
                        0 => array(
                            'type' => 'echo',
                            'expressions' => array(
                                0 => array(
                                    'type' => 'string',
                                    'value' => 'old',
                                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                                    'line' => 49,
                                    'char' => 19
                                )
                            ),
                            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                            'line' => 50,
                            'char' => 5
                        )
                    ),
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 47,
                    'last-line' => 51,
                    'char' => 36
                )
            ),
            'constants' => array(
                0 => array(
                    'type' => 'const',
                    'name' => 'CONSTANT_TEXT',
                    'default' => array(
                        'type' => 'string',
                        'value' => 'aaaaa',
                        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                        'line' => 13,
                        'char' => 34
                    ),
                    'docblock' => '**
     * hogege
     *',
                    'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
                    'line' => 17,
                    'char' => 6
                )
            ),
            'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
            'line' => 8,
            'char' => 5
        ),
        'file' => '/source/vendor/zephir-ide-helper/tests/src/../files/greeting.zep',
        'line' => 8,
        'char' => 5
    )
);
