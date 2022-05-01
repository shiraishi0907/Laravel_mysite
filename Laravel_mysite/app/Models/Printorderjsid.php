<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Printorderjsid extends Model
{
    public function printorderjsidModelGet() {
        $printorderjsids = DB::table('printorderjsids')->get();
        return $printorderjsids;
    }
}
