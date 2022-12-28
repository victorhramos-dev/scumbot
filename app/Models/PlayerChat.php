<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlayerChat extends Model
{
    /**
     * Interacts with message conversion utf8/mb4
     *
     * @return \Illuminate\Database\Eloquent\Casts\Attribute
     */
    protected function message(): Attribute
    {
        return Attribute::make(
            get: fn($value) => utf8_decode($value),
            set: fn($value) => utf8_encode($value),
        );
    }
}
