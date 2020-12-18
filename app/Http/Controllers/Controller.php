<?php

namespace App\Http\Controllers;

use DB;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController {

    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct() {
        $this->data = [
            'version' => '0.14111'
        ];
    }
}
