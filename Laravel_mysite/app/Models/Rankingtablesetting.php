<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Rankingtablesetting extends Model
{
    public function rankingtablesettingModelInsert($loginid) {
        $insert = [
            'loginid' => $loginid,
            'rankingsetting_default_flag' => 1,
            'film' => 1,
            'comic' => 1,
            'anime' => 1,
            'user_value_id' => 1
        ];
        $rankingtablesettings = DB::table('rankingtablesettings')->insert($insert);
        return $rankingtablesettings;
    }

    public function rankingtablesettingModelGet() {
        $where = [
            'loginid' => session('loginid')
        ];
        $rankingtablesettings = DB::table('rankingtablesettings')->where($where)->get();
        return $rankingtablesettings;
    }

    public function rankingtablesettingModelUpdate($rankingsetting,$title,$data) {
        $set = DB::table('rankingtablesettings');
        $where = [
            'loginid' => session('loginid')
        ];
        switch ($rankingsetting) {
            case 'rankingsettingdefaultflag':
                $update = [
                    'rankingsetting_default_flag' => $data
                ];
                $set->where($where)->update($update);
                break;
            case 'work':
                $update = [
                    $title => $data
                ];
                $set->where($where)->update($update);
                break;
        }
    }
}
