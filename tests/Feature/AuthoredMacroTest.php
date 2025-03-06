<?php

namespace Rulr\Authored\Tests\Feature;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Rulr\Authored\Tests\TestCase;

class AuthoredMacroTest extends TestCase
{
    /** @test */
    public function it_adds_authored_columns_to_a_table()
    {
        $this->assertTrue(Schema::hasTable('posts'));

        $this->assertTrue(Schema::hasColumn('posts', 'created_by'));
        $this->assertTrue(Schema::hasColumn('posts', 'updated_by'));
    }
}
