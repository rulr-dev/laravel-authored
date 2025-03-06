<?php

namespace Rulr\Authored;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;

class AuthoredServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Publish config file
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/authored.php' => config_path('authored.php'),
            ], 'config');
        }

        // Define schema macro for configurable field names
        Blueprint::macro('authored', function () {
            $this->foreignId(config('authored.created_by', 'created_by'))->nullable()->constrained('users')->nullOnDelete();
            $this->foreignId(config('authored.updated_by', 'updated_by'))->nullable()->constrained('users')->nullOnDelete();
        });
    }

    /**
     * Register services.
     */
    public function register(): void
    {
        // Merge default config
        $this->mergeConfigFrom(__DIR__ . '/../config/authored.php', 'authored');
    }
}
