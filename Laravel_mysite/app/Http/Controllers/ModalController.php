<?php

namespace App\Http\Controllers;

use App\Models\Attributeanswer;
use App\Models\Attribute;
use App\Models\Attributetextanswer;
use Illuminate\Http\Request;

class ModalController extends Controller
{
    public function modalcomplete(Request $request, Attribute $attribute, Attributeanswer $attributeanswer, Attributetextanswer $attributetextanswer) {
        $modals = $request->all();

        for ($i = 0;$i < count($modals["modals"]);$i++) {
            $ans_id = $attribute->attributeModelExist($modals["modals"][$i]);

            if ($modals["type"][$i] >= 3) {
                $attributetextanswer->attributetextanswerModelInsert($ans_id,$modals["id"][$i]);
            }
            $attributeanswer->attributeanswerModelInsert($ans_id);
        }
    }
}
