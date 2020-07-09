<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Forum extends Model
{
    const FORUM_IMAGE_URL = '/img';
    const FORUM_IMAGE_DEFAULT = 'forum.png';

    const KATEGORI_BEASISWA = 'beasiswa';
    const KATEGORI_PKM = 'pkm';

    protected $fillable = ['user_id', 'title', 'content', 'level', 'image'];

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getImageURLAttribute()
    {
        return asset($this::FORUM_IMAGE_URL).'/'.$this->image;
    }
    
    public function deleteImage()
    {
        if($this->image!=$this::FORUM_IMAGE_DEFAULT)
        {
            return Storage::disk('images')->delete($this->image);
        }
        return TRUE;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function scopeFromUser($query, $user_id)
    {
        return $query->where('user_id', $user_id);
    }
}
