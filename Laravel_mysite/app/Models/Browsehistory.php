<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Browsehistory extends Model
{
    public function browsehistoryModelGet() {
        $where = [
            'loginid' => session('loginid')
        ];
        $browsehistories = DB::table('browsehistories')->where($where)->orderBy('history_time','DESC')->limit(10)->get();
        return $browsehistories;
    }

    public function browsehistoryModelInsert($loginid,$workid,$db) {
        $insert = [
            'loginid' => $loginid,
            'workid' => $workid,
            'DB_table_name' => $db,
            'history_time' => now()
        ];
        DB::table('browsehistories')->insert($insert);
    }
}
