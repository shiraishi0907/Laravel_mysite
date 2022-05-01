<?php

namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use App\Http\Controllers\Mail\MailController;
use App\Models\Opinion;
use App\Models\User;
use Illuminate\Http\Request;

class OpinionController extends Controller
{
    public function opinion(User $user) {
        if (session('loginid')) { //ログインしている時
            $users = $user->userModelGet(session('loginid'));
            foreach ($users as $ur) {
                $nickname = $ur->nickname;
            };
        } else { //ログインしていない時
            $nickname = 'Guest';
        }
        return view('auth.opinion',compact('nickname'));
    }

    public function opinionconf(Request $request) {
        $nickname = $request->name;
        $opiniontitle = $request->opiniontitle;
        $opiniongenre = $request->opiniongenre;
        $opinionbody = $request->opinionbody;
        return view('auth.opinionconfirmation',compact('nickname','opiniontitle','opiniongenre','opinionbody'));
    }

    public function opinioncomplete(Request $request, User $user, Opinion $opinion) {
        $loginid = $user->userModelSearch('nickname',$request->name,'loginid');
        $email = $user->userModelSearch('nickname',$request->name,'email');
        $opinion->opinionModelInsert($loginid,$request->opiniontitle,$request->opiniongenre,$request->opinionbody);

        $params['nickname'] = $request->name;
        $params['opiniontitle'] = $request->opiniontitle;
        $params['opiniongenre'] = $request->opiniongenre;
        $params['opinionbody'] = $request->opinionbody;
        $mail = new MailController;
        $mail->mail('opinion',NULL,$email,$params);
        return view('auth.opinioncomplete');
    }
}
