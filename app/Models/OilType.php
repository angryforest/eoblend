<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\Type;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OilType extends BaseModel 
{
    use SoftDeletes;

    protected $table = 'oil_types';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'oil_id',
        'type_id',
    ];

    protected $hidden = [
        'id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function type()
    {
        return $this->belongsTo(Type::class);
    }
}
