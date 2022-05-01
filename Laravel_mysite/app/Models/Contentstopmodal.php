<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contentstopmodal extends Model
{

    public function contentstopmodalModelGet() {
        $contentstopmodals = DB::table('contentstopmodals')->get();
        return $contentstopmodals;
    }

    public function contentstopmodalModalJoinGet() {
        $contentstopmodals = DB::table('contentstopmodals')->
            Join('printorderjsids','contentstopmodals.print_order','=','printorderjsids.print_order')->get();
        return $contentstopmodals;
    }

    public function contentstopmodalModelExist($print_order) {
        $attr = DB::table('contentstopmodals')
            ->join('attributes',function($join) use ($print_order) {
                $join->on('attributes.print_order','=','contentstopmodals.print_order')
                    ->where('contentstopmodals.print_order','=',$print_order);
        })->orderBy('print_q_display_order','ASC')->get();

        $i = 0;
        foreach ($attr as $ar) {
            $attrkey["q_explain"] = $ar->q_explain;
            $attrkey["q_body"] = $ar->q_body;
            $attrkey["q_attribute"][$i] = $ar->q_attribute;
            $attrkey["type_id"] = $ar->type_id;
            $attrkey["attr_id"][$i] = $ar->attr_id;
            $attrkey["name_id"] = $ar->name_id;
            $i++;
        }
        return $attrkey;
    }
}
