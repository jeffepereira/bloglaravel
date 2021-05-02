<?php

namespace Jeffpereira\Blog\Tests;

use Exception;
use Jeffpereira\Blog\BlogServiceProvider;
// use LaravelLegends\PtBrValidator\ValidatorProvider;
// When testing inside of a Laravel installation, the base class would be Tests\TestCase
class TestCase extends \Orchestra\Testbench\TestCase
{
    // When testing inside of a Laravel installation, this is not needed
    protected function getPackageProviders($app)
    {
        return [
            BlogServiceProvider::class //, ValidatorProvider::class
        ];
    }
    // When testing inside of a Laravel installation, this is not needed
    protected function setUp(): void
    {
        parent::setUp();
        $this->withFactories(realpath(__DIR__ . "/../src/database/factoriesTest"));
        $this->loadMigrationsFrom(realpath(__DIR__ . "/../src/database/migrationsTest"));
        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }
    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('app.debug', 'true');
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            // 'database' => ':memory:',
            'database' => 'database.sqlite',
            'prefix'   => '',
            'exec'     => 'PRAGMA foreign_keys = ON;',
            'engine'   => "InnoDB",
            'foreign_key_constraints' => true
        ]);

        // $app['config']->set('database.default', 'mysql');

        // $app['config']->set('database.connections.mysql', [
        //     'driver'   => 'mysql',
        //     'host'        => "127.0.0.1", //env('DB_HOST', 'localhost'),
        //     'port'        => 3306, //env('DB_PORT', 3306),
        //     'database'    => "blog", //env('DB_DATABASE', 'blog'),
        //     'username'    => "blog", //env('DB_USERNAME', 'blog'),
        //     'password'    => "secret", //env('DB_PASSWORD', 'secret'),
        //     'unix_socket' => "",
        //     'charset'     => 'utf8mb4',
        //     'collation'   => 'utf8mb4_unicode_ci',
        //     'prefix'      => '',
        //     'strict'      => true,
        //     'engine'      => "InnoDB",
        // ]);
        // dd($app['config']['database']);
    }
}
