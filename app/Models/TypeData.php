<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TypeData extends BaseModel 
{
    use SoftDeletes;

    protected $table = 'type_data';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'language',
    ];

    protected $hidden = [
        'type_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
