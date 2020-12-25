<?php

namespace App\Models;

use App\Models\BaseModel;
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

    public static function getMapById() {
        $query = Oil::all();
        $map = [];
        foreach ($query as $item)
            $map[$item->id] = $item;
        return $map;
    }

    public static function getMapByName() {
        $query = Oil::all();
        $map = [];
        foreach ($query as $item)
            $map[$item->name] = $item;
        return $map;
    }
}
