<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Post extends Model
{
    public function postModelGet($workid) {
        $where = [
            'workid' => $workid
        ];
        $posts = DB::table('posts')->where($where)->get();
        return $posts;
    }

    public function postModelInsert($loginid,$workid,$poststar,$postbody) {
        $insert = [
            'loginid' => $loginid,
            'workid' => $workid,
            'poststar' => $poststar,
            'postbody' => $postbody,
        ];
        DB::table('posts')->insert($insert);
    }

}
