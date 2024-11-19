<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Connection;
use Illuminate\Database\Connectors\Connector;
use Illuminate\Database\Connectors\ConnectorInterface;

class OdbcServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('db.connector.odbc', function () {
            return new class extends Connector implements ConnectorInterface {
                public function connect(array $config)
                {
                    $dsn = $config['dsn'];
                    $options = $this->getOptions($config);

                    return $this->createConnection($dsn, $config, $options);
                }
            };
        });

        $this->app->resolving('db', function ($db) {
            $db->extend('odbc', function ($config, $name) {
                $config['name'] = $name;

                $connector = $this->app['db.connector.odbc'];
                $connection = $connector->connect($config);

                return new Connection($connection, $config['database'], $config['prefix'], $config);
            });
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
