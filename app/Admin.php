<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;


class Admin extends Model
{
    const ADMIN_LEVEL_ADMIN = 'admin';
    const ADMIN_LEVEL_OPERATOR = 'kemahasiswaan';

    protected $fillable = [
        'user_id', 'position', 'level'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }

    public function spm()
    {
        return $this->hasMany(Spm::class);
    }
}
