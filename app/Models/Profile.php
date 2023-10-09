<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'full_address',
        'date_of_birth',
        'qualification',
        'designation',
        'skills',
        'status',
        'salary',
    ];

    protected $casts = [
        'full_address' => 'json',
        'permissions' => 'json',
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
