<?php
return [
    'catalogo' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'dbname' => getenv('DB_CATALOGO_NAME'),
        'username' => getenv('DB_CATALOGO_USER'),
        'password' => getenv('DB_CATALOGO_PASS'),
        'charset' => 'utf8'
    ],
    'servidores' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'dbname' => getenv('DB_SERVIDORES_NAME'),
        'username' => getenv('DB_SERVIDORES_USER'),
        'password' => getenv('DB_SERVIDORES_PASS'),
        'charset' => 'utf8'
    ],
    'sys' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'dbname' => getenv('DB_SYS_NAME'),
        'username' => getenv('DB_SYS_USER'),
        'password' => getenv('DB_SYS_PASS'),
        'charset' => 'utf8'
    ],
    'apsweb' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_HOST') ?: 'localhost',
        'dbname' => getenv('DB_APSWEB_NAME'),
        'username' => getenv('DB_APSWEB_USER'),
        'password' => getenv('DB_APSWEB_PASS'),
        'charset' => 'utf8'
    ],
    'apsdistribuido03_sh2' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_SH2_HOST'),
        'dbname' => getenv('DB_DISTRIBUIDO03_SH2_NAME'),
        'username' => getenv('DB_DISTRIBUIDO03_SH2_USER'),
        'password' => getenv('DB_DISTRIBUIDO03_SH2_PASS'),
        'charset' => 'utf8'
    ],
    'apsdistribuido04_sh2' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_SH2_HOST'),
        'dbname' => getenv('DB_DISTRIBUIDO04_SH2_NAME'),
        'username' => getenv('DB_DISTRIBUIDO04_SH2_USER'),
        'password' => getenv('DB_DISTRIBUIDO04_SH2_PASS'),
        'charset' => 'utf8'
    ],
    'apsdistribuido03_king' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_KING_HOST'),
        'dbname' => getenv('DB_DISTRIBUIDO03_KING_NAME'),
        'username' => getenv('DB_DISTRIBUIDO03_KING_USER'),
        'password' => getenv('DB_DISTRIBUIDO03_KING_PASS'),
        'charset' => 'utf8'
    ],
    'apsdistribuido04_king' => [
        'driver' => getenv('DB_DRIVER') ?: 'mysql',
        'host' => getenv('DB_KING_HOST'),
        'dbname' => getenv('DB_DISTRIBUIDO04_KING_NAME'),
        'username' => getenv('DB_DISTRIBUIDO04_KING_USER'),
        'password' => getenv('DB_DISTRIBUIDO04_KING_PASS'),
        'charset' => 'utf8'
    ]
];
