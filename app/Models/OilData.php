<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OilData extends BaseModel 
{
    use SoftDeletes;

    protected $table = 'oil_data';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'language',
        'title',
        'description',
        'plant',
        'aroma',
        'properties',
        'methods',
        'contraindications',
    ];

    protected $hidden = [
        'oil_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
