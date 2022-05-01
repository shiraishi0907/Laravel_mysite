<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attributetextanswer extends Model
{
    public function attributetextanswerModelInsert($ans_id,$attrtext) {
        $insert = [
            'loginid' => session('loginid'),
            'ans_id' => $ans_id,
            'text' => $attrtext,
            'created_at' => date('Y-m-d')
        ];
        DB::table('attributetextanswers')->insert($insert);
    }
}
