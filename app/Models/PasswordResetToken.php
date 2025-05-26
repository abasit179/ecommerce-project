<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PasswordResetToken extends Model
{
    // Disable auto-increment assumption for Eloquent
    public $incrementing = false;

    // Specify the primary key column
    protected $primaryKey = 'id';

    protected $fillable = [
        'email', 'token', 'used'
    ];

    protected $casts = [
        'used' => 'boolean'
    ];
}