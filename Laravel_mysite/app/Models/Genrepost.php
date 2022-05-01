<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Genrepost extends Model
{
    public function genrepostModelGet() {
        $genreposts = DB::table('genreposts')->get();
        return $genreposts;
    }
}
