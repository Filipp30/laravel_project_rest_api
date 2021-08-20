<?php

namespace App\Http\Controllers\GatesController;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;
class GateController extends Controller
{
    public function getData(){

        return response([
            'gate'=>Gate::allows('gate-data')
        ]);

    }
}
