<?php

/**
 * Archangel DB 2
 * www.archangel-design.com
 * @author Rafal Martinez-Marjanski
 * Official repo: https://github.com/ArchangelDesign/ArchangelDB2
 *
 * Sample configuration file. This file returns an array
 * for ConfigLoader, however you can just pass it as an
 * argument for ADB2 constructor.
 */

return [
    'driver' => 'mysqli',
    'database' => 'sm',
    'username' => 'admin',
    'password' => 'admin',
    'prefix' => 'sm_', // not required, prefix added to all tables (automatically)
    'profiler' => true, // recommended, if disabled some methods will not return results (like getLastQuery())
    'allow_drop' => true, // if false or not set, no drop command is allowed
    'deploy-file' => 'database-structure.xml',
    'storage-dir' => __DIR__ . '/storage',
    'enable-cache' => true,
    'enable-storage' => true, // enables use of queries stored in files
    'allow-deploy' => true, // whether to allow ADB to create the database, defaults to true
    'cache-dir' => __DIR__ . '/cache',
    'error-log-file' => __DIR__ . '/error.log',
    'options' => [
        'buffer_results' => true, // required for mysql and pgsql
        // if enabled, all results will be buffered. This option is required for ADB to work
        // properly, you can read about implications of this option on database provider site.
        // if not set, it defaults to true
    ]
];

return array(
    'driver' => 'pgsql',
    'dbname' => 'mis3',
    'dbuser' => 'admin',
    'dbpass' => 'admin',
    'prefix' => 'adb_',
    'profiler' => true,
);