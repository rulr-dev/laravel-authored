<?php

namespace Rulr\Authored\Tests;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Foundation\Auth\User;
use Orchestra\Testbench\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Rulr\Authored\AuthoredServiceProvider;

class TestCase extends BaseTestCase
{
    use RefreshDatabase;

    /**
     * Load package service provider.
     */
    protected function getPackageProviders($app): array
    {
        return [
            AuthoredServiceProvider::class,
        ];
    }

    /**
     * Set up the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        Schema::dropIfExists('test_models');

        // Create a test table
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->authored();
            $table->timestamps();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });
    }

    protected function createUser(): User
    {
        $user = new User;
        $user->name = fake()->name();
        $user->email = fake()->email();
        $user->password = fake()->password();

        return $user;
    }
}
