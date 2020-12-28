<?php

namespace App\Models;

use App\Models\BaseModel;
use App\Models\OilData;
use App\Models\OilType;
use App\Models\OilProperty;
use App\Models\Compatibility;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Oil extends BaseModel 
{  
    use SoftDeletes;

    protected $table = 'oils';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'name',
        'volatility',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function data()
    {
        return $this->hasMany(OilData::class);
    }

    public function types()
    {
        return $this->hasMany(OilType::class);
    }

    public function properties()
    {
        return $this->hasMany(OilProperty::class);
    }

    public function compatibility()
    {
        return $this->hasMany(Compatibility::class);
    }
}
