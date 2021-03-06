<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\TypeData;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Type extends BaseModel 
{
    use SoftDeletes;

    protected $table = 'types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function data()
    {
        return $this->hasMany(TypeData::class);
    }
}
