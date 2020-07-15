<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Kegiatan extends Model
{
    
    const ARTICLE_IMAGE_URL = '/img';
    const ARTICLE_IMAGE_DEFAULT = 'kegiatan.pdf';

    const KEGIATAN_STATUS_CONFIRMED = 1;
    const KEGIATAN_STATUS_NOT_CONFIRMED = 0;

    protected $fillable = ['member_id', 'title',  'image', 'confirmed'];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
    
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;
        $this->attributes['slug'] = Str::slug($value);
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

    public function scopeFromMember($query, $member_id)
    {
        return $query->where('member_id', $member_id);
    }

    public function scopeConfirmed($query)
    {
        return $query->where('confirmed', $this::KNOWLEDGE_STATUS_CONFIRMED);
    }

    public function getStatusInLabelAttribute()
    {
        switch($this->status)
        {
            case $this::KNOWLEDGE_STATUS_CONFIRMED:
                $message = "Sudah di Validasi";
                $label = 'info';
                break;
            case $this::KNOWLEDGE_STATUS_NOT_CONFIRMED:
                $message = "Belum di Validasi";
                $label = 'danger';
                break;
            default:
                $message = "Belum di Validasi";
                $label = 'danger';
                break;
        }

        return "<span class='badge badge-$label'>$message</span>";
    }

}
