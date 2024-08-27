<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use HasFactory;
    use Sluggable;
    protected $table = 'posts';
    protected $primaryKey = 'id';
    protected $fillable = [
        'user_id',
        'title',
        'excerpt',
        'body',
        'published_at',
        'image',
    ];
    public function sluggable(): array
    {  
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        parent::boot();
   
        static::creating(function ($post) {
            $post->excerpt = self::generateExcerpt($post->body);
            $post->published_at = Carbon::now();
        });

    }

    public function getExcerptAttribute()
    {
        return $this->generateExcerpt($this->body);
    }

    public function setBodyAttribute($value)
    {
        $this->attributes['body'] = $value;
        $this->attributes['excerpt'] = $this->generateExcerpt($value);
    }
   
    public static function generateExcerpt($body, $maxLength = 150)
{
    // $text = strip_tags($body); // Remove HTML tags
    $text = $body;
    $text = str_replace('&nbsp;', ' ', $text); // Replace non-breaking space with a space
    $text = trim($text); // Remove leading/trailing whitespace
    $words = explode(' ', $text);
    $excerpt = implode(' ', array_slice($words, 0, $maxLength));

    // Check if the excerpt ends with punctuation
    $lastChar = mb_substr($excerpt, -1);
    if (preg_match('/[.!?]/u', $lastChar) === 0) {
        // Find the last complete sentence within the maximum length
        $lastSentence = '';
        $sentencePattern = '/(?<=[.!?])\s+/u';
        $sentences = preg_split($sentencePattern, $text);
        foreach ($sentences as $sentence) {
            if (mb_strlen($excerpt . $sentence) <= $maxLength) {
                $lastSentence = $sentence;
            } else {
                break;
            }
        }
        $excerpt .= $lastSentence;
    }

    if (count($words) > $maxLength) {
        $excerpt .= '...';
    }

    return $excerpt;
}
    

}