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
        if (!$this->cover_image) return asset('images/music_placeholder.jpg');
        if (Str::startsWith($this->cover_image, 'http')) {
            return $this->cover_image;
        }
        return asset('storage/' . $this->cover_image);
    }
}
