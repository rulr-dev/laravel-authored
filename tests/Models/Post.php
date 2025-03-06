<?php

namespace Rulr\Authored\Tests\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Rulr\Authored\Traits\HasAuthor;

class Post extends Model
{
    use HasFactory, HasAuthor;
    protected $guarded = [];
}