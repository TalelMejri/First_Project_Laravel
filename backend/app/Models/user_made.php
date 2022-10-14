<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class user_made extends Model
{
    use HasFactory;
    protected $fillable=[
        'name',
        'email',
    ];
}
