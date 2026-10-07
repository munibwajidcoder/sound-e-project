<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Music extends Model
{
    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'item_id')->where('item_type', 'music');
    }

    public function getAudioUrl()
    {
        if (!$this->audio_url) return '';
        if (Str::startsWith($this->audio_url, 'http')) {
            return $this->audio_url;
        }
        return asset('storage/' . $this->audio_url);
    }

    public function getCoverUrl()
    {
        if (!$this->cover_image) return asset('images/music_1.jpg');
        
        $cover = $this->cover_image;
        if (Str::startsWith($cover, 'http://') || Str::startsWith($cover, 'https://')) {
            return $cover;
        }
        if (Str::startsWith($cover, '/images/')) {
            return asset($cover);
        }
        if (file_exists(public_path('images/' . $cover))) {
            return asset('images/' . $cover);
        }
        if (file_exists(public_path($cover))) {
            return asset($cover);
        }
        return asset('storage/' . $cover);
    }
}
