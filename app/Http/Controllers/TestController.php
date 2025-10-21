<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestController extends Controller
{
    public function __invoke()
    {
        return 'This is the __invoke method of TestController';
    }
}
