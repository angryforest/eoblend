<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oil extends Model {
    
    use SoftDeletes;

    protected $table = 'oils';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'url',
        'eng_name',
        'rus_name',
        'volatility',
        'cover'
    ];

    protected $hidden = [];
}
