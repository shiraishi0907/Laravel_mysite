<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Work extends Model
{

    public function workAllModelGet() {
        $workfilms = DB::table('workfilms')->get();
        $workanimes = DB::table('workanimes')->get();

        $i = 0;
        foreach ($workfilms as $film) {
            //$filmsurl = $film->url;
            $filmlists = explode('/',$filmsurl);
            $workall[$i] = $film->title;
            //$workall[$i]["".$filmlists[0].""] = $film->title;
            $i++;
        }

        $j = count($workall);
        foreach ($workanimes as $anime) {
            //$animesurl = $anime->url;
            //$animelists = explode('/',$animesurl);
            $workall[$j] = $anime->title;
            //$workall[$j]["".$animelists[0].""] = $anime->title;
            $j++;
        }

        /**
         * 作品名でソートの仕方がわからない
         * ※配列で渡した作品が何のジャンルかがわかるようになっていること前提
         */
        return $workall;
    }

    public function workModelWhere($key,$whereColumn,$word = NULL,$work = NULL,$artist = NULL,$keyword = NULL,$worktablename) {
        switch ($key) {
            case 'worksindetail':
                $where = [
                    $whereColumn => $word,
                ];
                $works = DB::table($worktablename)->where($where)->get();
                break;
            //五十音検索のひらがなで始まる検索
            case 'worksearch':
                $works = DB::table($worktablename);
                if ($word) {
                    $works = $works->where('furigana','like',''.$word[0].'%');
                    if (count($word) > 1) {
                        for ($i = 1;$i < count($word);$i++) {
                            $works = $works->OrWhere('furigana','like',''.$word[$i].'%');
                        }
                    }
                }
                if ($work) $works = $works->where('furigana','like',"%$work%");
                if ($keyword) $works = $works->where('explaining','like',"%$keyword%");
                $works = $works->get();
                break;
        }
        return $works;
    }

    public function workModelGet($worktablename,$wherecolumn,$wheredata) {
        $works = DB::table($worktablename);
        if ($wherecolumn != NULL) {
            $where = [
                $wherecolumn => $wheredata,
            ];
            $works = $works->where($where);
        }
        $works = $works->get();
        return $works;
    }

    public function workDBModelGet($workid,$title,$furigana,$img,$url,$explaing) {
        if (($workid >= 10000001 && $workid <= 20000000) || ($url == 'anime')) {
            $db = 'workanimes';
        } elseif (($workid >= 20000001 && $workid <= 30000000) || ($url == 'film')) {
            $db = 'workfilms';
        } else {
            $db = 'workcomics';
        }
        return $db;
    }
}
