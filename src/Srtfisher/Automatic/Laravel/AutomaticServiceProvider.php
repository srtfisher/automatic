<?php
namespace Srtfisher\Automatic\Laravel;

use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;
use Srtfisher\Automatic\Client;
use Auth;

class AutomaticServiceProvider extends ServiceProvider
{
    const VERSION = '0.1.0';

    /**
     * Client Storage
     *
     * @type Client
     */
    public static $client;

    /**
     * Register the Service Provider
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('automatic', function ($app) {
            $config = $app['config']['automatic'] ?: $app['config']['automatic::config'];

            if (! AutomaticServiceProvider::$client) {
                AutomaticServiceProvider::$client = new Client(
                    $config['clientId'],
                    $config['clientSecret'],
                    null,
                    $config['redirectUri']
                );
            }

            // Automatically detect the user's token
            if (Auth::check() && Auth::user() instanceof AutomaticUserInterface) {
                AutomaticServiceProvider::$client->setToken(Auth::user()->getAutomaticAccessToken());
            }

            return AutomaticServiceProvider::$client;
        });
    }

    /**
     * Bootstrap the application
     *
     * @return void
     */
    public function boot()
    {
        $this->package('srtfisher/automatic');
    }

    /**
     * Get the services provided by the provider
     *
     * @return array
     */
    public function provides()
    {
        return ['automatic'];
    }
}
