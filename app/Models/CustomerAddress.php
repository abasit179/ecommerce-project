<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;

    protected $fillable = [
                'user_id' ,
                'first_name',
                'last_name',
                'email',
                'address',
                'country',
                'city',
                'state',
                'zip',
                'mobile',
                'apartment',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
