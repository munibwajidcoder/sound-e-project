<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Video extends Model
{
    protected $guarded = [];

    public function reviews()
    {
        return $this->hasMany(Review::class, 'item_id')->where('item_type', 'video');
    }

    public function getVideoUrl()
    {
        if (!$this->video_file) return '';
        if (Str::startsWith($this->video_file, 'http')) {
            return $this->video_file;
        }
        return asset('storage/' . $this->video_file);
    }

    public function getThumbnailUrl()
    {
        if (!$this->thumbnail) return asset('images/video_placeholder.jpg');
        if (Str::startsWith($this->thumbnail, 'http')) {
            return $this->thumbnail;
        }
        return asset('storage/' . $this->thumbnail);
    }
}
