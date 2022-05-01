<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\Attributeanswer;
use App\Models\Point;
use App\Models\Rankingsetting;
use App\Models\Rankingtablesetting;
use App\Models\User;
use Illuminate\Http\Request;

class MypageController extends Controller
{
    public function mypage() {
        return view('mypage.mypage');
    }

    public function nicknamechange() {
        return view('mypage.nicknamechange');
    }

    public function nicknamechangecomplete(Request $request, User $user) {
        $newnickname = $request->newnickname;
        $user->userModelUpdate('loginid',session('loginid'),'nickname',$newnickname);
        return view('mypage.nicknamechangecomplete');
    }

    public function passwordchange() {
        return view('mypage.passwordchange');
    }

    public function passwordchangecomplete(Request $request, User $user) {
        $newpassword = $request->newpassword;
        $user->userModelUpdate('loginid',session('loginid'),'password',password_hash($newpassword,PASSWORD_DEFAULT));
        return view('mypage.passwordchangecomplete');
    }

    public function attribute(Attribute $attribute, Attributeanswer $attributeanswer) {
        $attributes = $attribute->attributeModelGet();
        $attributeanswersid = $attributeanswer->attributeanswerModelGet();
        $i = 0;
        foreach ($attributeanswersid as $id) {
            $attrid[$i] = $id->attr_id;
            $i++;
        }
        return view('mypage.attribute',compact('attributes','attrid'));
    }

    public function statistics() {
        return view('mypage.statistics');
    }

    public function setting(Attribute $attribute, Rankingsetting $rankingsetting, Rankingtablesetting $rankingtablesetting) {
        $attributessetting = $attribute->attributeSettingModelGet();
        $rankingdefaultsetting = $rankingsetting->rankingsettingFlagModelGet();
        $rankingsetting = $rankingsetting->rankingsettingModelGet();
        $rankingtablesetting = $rankingtablesetting->rankingtablesettingModelGet();

        $i = 0;
        foreach ($attributessetting as $setting) {
            $attributeq[$i] = $setting->q_attribute;
            $attributeattrid[$i] = $setting->attr_id;
            $i++; 
        }

        $i = 0;
        foreach ($rankingdefaultsetting as $defaultsetting) {
            $defaulttablesetting = $defaultsetting->table_title;
            $i++;
        }

        $i = 0;
        foreach ($rankingsetting as $defaultsetting) {
            $tablesetting[$i] = $defaultsetting->table_title;
            $firstdisplayflag[$i] = $defaultsetting->first_display_flag;
            $i++;
        }

        $rankingtablist = []; 
        foreach ($rankingtablesetting as $table) {
            array_push($rankingtablist,$table->film);
            array_push($rankingtablist,$table->comic);
            array_push($rankingtablist,$table->anime);
        }
        return view('mypage.setting',compact('attributeq','attributeattrid','defaulttablesetting','tablesetting','firstdisplayflag','rankingtablist'));
    }

    public function mypagesetting(Request $request, Rankingtablesetting $rankingtablesetting) {
        $mypagesetting = $request->all();

        $rankingtablesetting->rankingtablesettingModelUpdate('rankingsettingdefaultflag',NULL,$mypagesetting["table"]);
        for ($i = 0;$i < count($mypagesetting["tab"]);$i++) {
            $rankingtablesetting->rankingtablesettingModelUpdate('work',$mypagesetting["tabid"][$i],$mypagesetting["tab"][$i]);
        }

        $setmsg = "設定変更しました。";
        return response()->json(
            [
                "msg" => $setmsg,
            ],
        );
    }

    public function information(User $user, Point $point) {
        $points = $point->pointModelGet();
        $users = $user->userModelGet(session('loginid'));
        $users = $users[0];
        return view('mypage.information',compact('users','points'));
    }
}
