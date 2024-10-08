<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [ 'name',
                            'email',
                            'phone',
                            'role',
                            'password',];

    protected $casts = [
        'password' => 'hashed',
    ];

}
