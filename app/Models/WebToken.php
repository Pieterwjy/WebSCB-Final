<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebToken extends Model
{
    // use HasFactory;
    protected $table = 'webpush_token';

    protected $fillable = [
        'web_token'
    ];
    public $timestamps = false;
}
