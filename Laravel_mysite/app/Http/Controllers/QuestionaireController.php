<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Questionairereview;
use Illuminate\Http\Request;
use App\Models\Questionairegenre;

class QuestionaireController extends Controller
{
    public function questionaire(Questionairegenre $questionairegenre) {
        $questionaire = $questionairegenre->questionairegenreModelget();
        return view('questionaire',compact('questionaire'));
    }

    public function questionaireconfirm(Request $request, Questionairegenre $questionairegenre) {
        $name = $request->name;
        $mail = $request->mail;
        $phone = $request->phone;
        $questionairegenreid = $request->questionairegenre;
        session(['questionairegenreid' => $questionairegenreid]);
        $questionairegenre = $questionairegenre->questionairegenreidModelget($questionairegenreid);
        $questionaire = $request->questionaire;
        session(['questionaire' => $questionaire]);
        return view('questionaireconfirm',compact('name','mail','phone','questionairegenre','questionaire'));
    }

    public function questionairecomplete(Questionairereview $questionairereview) {
        $questionairereview->questionairereviewModel();
        return view('questionairecomplete');
    }
}
