<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Authorship Column Names
    |--------------------------------------------------------------------------
    |
    | Here you may define the column names that will be used to track
    | the user who created and last updated a model. You may want to
    | change these if you already have a convention in place.
    |
    */

    'created_by' => 'created_by',
    'updated_by' => 'updated_by',

    /*
    |--------------------------------------------------------------------------
    | User Model
    |--------------------------------------------------------------------------
    |
    | This option controls which Eloquent model should be used to
    | represent the user. If your application uses a custom
    | authentication model, update this value accordingly.
    |
    */

    'user_model' => \App\Models\User::class,

];
