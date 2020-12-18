<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OilProperty extends Model {

    use SoftDeletes;

    protected $table = 'oil_properties';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $fillable = [
        'oil_id',
        'property_id'
    ];

    protected $hidden = [];
}
