<?php

namespace App\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Specification extends BaseModel 
{
    use SoftDeletes;

    protected $table = 'specifications';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'oil_id',
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
        'created_at',
        'updated_at',
        'deleted_at',
    ];
}
