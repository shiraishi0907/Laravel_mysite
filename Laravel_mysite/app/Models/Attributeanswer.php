<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Attributeanswer extends Model
{
    public function attributeanswerModelInsert($ans) {
        $insert = [
            'loginid' => session('loginid'),
            'ans_id' => $ans,
            'created_at' => date('Y-m-d')
        ];
        DB::table('attributeanswers')->insert($insert);
    }

    public function attributeanswerModelGet() {
        $where = [
            'loginid' => session('loginid')
        ];
        $attributesid = DB::table('attributeanswers')->
            Join('attributes','attributeanswers.ans_id','=','attributes.answer_id')->select('attr_id')->where($where)->get();
        return $attributesid;
    }
}
