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

    protected function getPackageProviders($app): array
    {
        return [
            AuthoredServiceProvider::class,
        ];
    }

    protected function setUp(): void
    {
        parent::setUp();

        config(['authored.user_model' => User::class]);

        Schema::dropIfExists('posts');
        Schema::dropIfExists('users');

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

        $user->save();

        return $user;
    }
}
