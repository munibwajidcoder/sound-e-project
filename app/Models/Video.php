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
        if (!$this->thumbnail) return asset('images/video_1.jpg');
        
        $thumb = $this->thumbnail;
        if (Str::startsWith($thumb, 'http://') || Str::startsWith($thumb, 'https://')) {
            return $thumb;
        }
        if (Str::startsWith($thumb, '/images/')) {
            return asset($thumb);
        }
        if (file_exists(public_path('images/' . $thumb))) {
            return asset('images/' . $thumb);
        }
        if (file_exists(public_path($thumb))) {
            return asset($thumb);
        }
        return asset('storage/' . $thumb);
    }
}
