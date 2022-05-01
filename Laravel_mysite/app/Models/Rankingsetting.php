<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rankingsetting extends Model
{
    public function rankingsettingFlagModelGet() {
        $where = [
            'loginid' => session('loginid')
        ];
        $rankingflagconfigs = DB::table('rankingsettings')
            ->join('rankingtablesettings',function($join) use ($where) {
            $join->on('rankingsettings.first_display_flag','=','rankingtablesettings.rankingsetting_default_flag')
                ->where($where);
        })->get();
        return $rankingflagconfigs;
    }

    public function rankingsettingModelGet() {
        $rankingconfigs = DB::table('rankingsettings')->get();
        return $rankingconfigs;
    }
}
