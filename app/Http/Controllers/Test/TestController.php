<?php

namespace App\Http\Controllers\Test;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Test;

class TestController extends Controller
{
    //
    public function detail($id)
    {
        $m = new Test();
        $m->test();
        return $id;

    }
}
