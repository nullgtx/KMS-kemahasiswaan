<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    const MEMBER_LEVEL_ADMIN = 'himpunan';
    const MEMBER_LEVEL_OPERATOR = 'mahasiswa';

    protected $fillable = ['nim', 'user_id', 'level'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function knowledge()
    {
        return $this->hasMany(Knowledge::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }


}
