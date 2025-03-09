<?php

namespace Rulr\Authored\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait HasAuthor
{
    public static function bootHasAuthor()
    {
        static::creating(function (Model $model) {
            if (Auth::check()) {
                $createdByColumn = config('authored.created_by', 'created_by');
                $model->$createdByColumn = Auth::id();
            }
        });

        static::updating(function (Model $model) {
            if (Auth::check()) {
                $updatedByColumn = config('authored.updated_by', 'updated_by');
                $model->$updatedByColumn = Auth::id();
            }
        });
    }

    public function creator()
    {
        return $this->belongsTo(config('authored.user_model', \App\Models\User::class), config('authored.created_by', 'created_by'));
    }

    public function updater()
    {
        return $this->belongsTo(config('authored.user_model', \App\Models\User::class), config('authored.updated_by', 'updated_by'));
    }
}
