<?php

namespace App\Models;{{  }}

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LiveStream extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','title', 'scheduled_at','scheduled_end', 'youtube_embed_url', 'status'];

    protected $dates = ['scheduled_at'];
    protected $dates_end = ['scheduled_end'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
