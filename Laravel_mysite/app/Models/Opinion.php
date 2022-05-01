<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Opinion extends Model
{
    public function opinionModelInsert($loginid,$opiniontitle,$opiniongenre,$opinionbody) {
        $insert = [
            'loginid' => $loginid,
            'opinion_title' => $opiniontitle,
            'opinion_genre' => $opiniongenre,
            'opinion_body' => $opinionbody
        ];
        DB::table('opinions')->insert($insert);
    }
}
