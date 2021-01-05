<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    use HasFactory;

    protected $table = 'page_views';

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    protected $fillable = [
        'ip',
        'url',
        'time',
        'agent',
        'mobile',
        'user_id',
        'referer',
        'language',
    ];

    protected $hidden = [
    ];
}
