<?php

namespace App\Models;

use App\Models\BaseModel;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PropertyData extends BaseModel 
{
    use SoftDeletes;

    protected $table = 'property_data';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'language',
        'description',
    ];

    protected $hidden = [
        'property_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
