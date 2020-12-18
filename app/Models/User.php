<?php

namespace App\Models;

use App\Notifications\VerifyEmail;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable implements MustVerifyEmail {

    use SoftDeletes,
        Notifiable;

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'email',
        'password'
    ];

    protected $hidden = [
        'permission',
        'password',
        'remember_token',
    ];

    public function sendEmailVerificationNotification() {
        $this->notify(new VerifyEmail);
    }
}
