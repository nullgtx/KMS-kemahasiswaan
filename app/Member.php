<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Member extends Model
{
    protected $fillable = ['nim', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


}
