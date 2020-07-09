<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use Notifiable;

    const USER_ROLE_ADMIN = 'admin';
    const USER_ROLE_MEMBER = 'member';
    
    const USER_IS_ACTIVE = '1';
    const USER_IS_NOT_ACTIVE = '0';

    const USER_PHOTO_URL = '/img';
    const USER_PHOTO_DEFAULT = 'user.png';


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role','active', 'photo'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = strtoupper($value);
    }

    public function setEmailAttribute($value)
    {
        $this->attributes['email'] = strtolower($value);
    }

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }

    public function member()
    {
        return $this->hasOne(Member::class);
    }

    public function forum()
    {
        return $this->hasMany(Forum::class);
    }

    public function komentar()
    {
        return $this->hasMany(Komentar::class);
    }

    public function getActiveInLabelAttribute()
    {
        switch($this->active)
        {
            case $this::USER_IS_ACTIVE:
                $message = "Aktif";
                $label = 'info';
                break;
            case $this::USER_IS_NOT_ACTIVE:
                $message = "Tidak Aktif";
                $label = 'danger';
                break;
            default:
                $message = "Tidak Aktif";
                $label = 'danger';
                break;
        }

        return "<span class='badge badge-$label'>$message</span>";
    }

    public function getPhotoURLAttribute()
    {
        return asset($this::USER_PHOTO_URL).'/'.$this->photo;
    }

    public function deletePhoto()
    {
        if($this->photo!=$this::USER_PHOTO_DEFAULT)
        {
            return Storage::disk('images')->delete($this->photo);
        }
        return TRUE;
    }


}
