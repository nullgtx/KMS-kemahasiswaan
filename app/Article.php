<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Article extends Model
{
    const ARTICLE_IMAGE_URL = '/img';
    const ARTICLE_IMAGE_DEFAULT = 'article.png';

    protected $fillable = ['admin_id', 'title', 'content', 'image'];

    public function admin()
    {
        return $this->belongsTo(Admin::class);
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function getShortDescAttribute()
    {
        return Str::limit(strip_tags($this->content), 80);
    }

    public function getImageURLAttribute()
    {
        return asset($this::ARTICLE_IMAGE_URL).'/'.$this->image;
    }
    
    public function deleteImage()
    {
        if($this->image!=$this::ARTICLE_IMAGE_DEFAULT)
        {
            return Storage::disk('images')->delete($this->image);
        }
        return TRUE;
    }

}
