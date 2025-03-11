# Laravel Authored

## Introduction

`rulr/laravel-authored` is a Laravel package that automatically assigns `created_by` and `updated_by` user IDs to Eloquent models. This helps track which user created and last updated a model, improving data auditing and accountability.

## Installation

You can install the package via Composer:

```bash
composer require rulr/laravel-authored
```

## Usage

### 1. Apply the `HasAuthor` Trait

To enable automatic tracking, add the `HasAuthor` trait to your Eloquent models:

```php
use Illuminate\Database\Eloquent\Model;
use Rulr\Authored\Traits\HasAuthor;

class Post extends Model
{
    use HasAuthor;
}
```

### 2. Use the `authored` Macro in Migrations

Instead of manually defining `created_by` and `updated_by`, you can use the provided macro when defining your schema:

```php
Schema::create('posts', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->authored(); // Automatically adds created_by and updated_by fields
    $table->timestamps();
});
```

### 3. Configuration

By default, this package uses `created_by` and `updated_by` columns. You can **customize** these field names by publishing and modifying the config file.

#### **Publishing the Config File**

```bash
php artisan vendor:publish --provider="Rulr\Authored\AuthoredServiceProvider" --tag=config
```

This will create a file at `config/authored.php`, where you can modify the column names:

```php
return [
    'created_by' => 'created_by',
    'updated_by' => 'updated_by',
];
```

Now, when using `$table->authored();`, it will use the specified field names.

### 4. Automatically Set User IDs

When a user creates or updates a model, Laravel will automatically assign their ID:

```php
$post = Post::create(['title' => 'First Post']);
$post->update(['title' => 'Updated Title']);

// Outputs the user ID who created the post
echo $post->created_by;

// Outputs the user ID who last updated the post
echo $post->updated_by;
```

## Testing

This package includes PHPUnit tests using Orchestra Testbench. The tests create tables dynamically without requiring migrations. To run tests, use:

```bash
vendor/bin/phpunit
```

## License

This package is open-source software licensed under the MIT license.

