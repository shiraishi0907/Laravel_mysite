<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class ConfirmPasswordController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    //ログイン画面にリダイレクトする↓
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }


    public function verifycomplete() {
        return view('auth.verifycomplete');
    }
}
