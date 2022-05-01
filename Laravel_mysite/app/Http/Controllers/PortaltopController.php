<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Anime;
use App\Models\Comic;
use App\Models\Film;
use App\Models\User;
use Illuminate\Http\Request;

class portaltopController extends Controller
{
    public function portaltop() {
        //$loginid = $request->loginid;
        //$password = $request->password;
        // if (session('newpassword')) {
        //     if (session('newpassword') !== $password) {
        //         return redirect('/login');
        //     } else {
        //         session()->forget('newpassword');
        //     }
        // } 

        // session(['loginid' => $loginid]);

        // $filmData = $film->filmModelGet();
        // $animeData = $anime->animeModelGet();
        // $comicData = $comic->comicModelGet();

        // $data = 8.1;
        // $data1 = json_encode($data);

        //return view('portaltop',compact('filmData','animeData','comicData','data1'));
        return view('contentstop');
    }

    public function rankingconfig() {
        return view('modal.rankingconfig');
    }
}
