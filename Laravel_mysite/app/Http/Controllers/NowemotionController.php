<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class NowemotionController extends Controller
{
    public function nowemotion() {
        return view('nowemotion');
    }
}
