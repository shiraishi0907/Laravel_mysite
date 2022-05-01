<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Favorite extends Model
{
    public function favoriteModelInsert($workid,$db) {
        $insert = [
            'loginid' => session('loginid'),
            'workid' => $workid,
            'DB_table_name' => $db
        ];
        DB::table('favorites')->insert($insert);
    }

    public function favoriteModelDelete($workid,$db) {
        $where1 = [
            'loginid' => session('loginid'),
        ];
        $where2 = [
            'workid' => $workid
        ];
        $where3 = [
            'DB_table_name' => $db
        ];
        DB::table('favorites')->where($where1)->orWhere($where2)->orWhere($where3)->delete();
    }

    public function favoriteAllModelGet() {
        $where = [
            'loginid' => session('loginid')
        ];
        $favoritesdata = DB::table('favorites')->where($where)->get();
        return $favoritesdata;
    }

    public function favoriteModelGet($worktable,$workid) {
        $favorites = DB::table('favorites')
            ->join($worktable,function($join) use ($worktable,$workid) {
                $join->on(''.$worktable.'.workid','=','favorites.workid')
                ->where('favorites.workid','=',$workid);
        })->get();
        return $favorites;
    }
}
