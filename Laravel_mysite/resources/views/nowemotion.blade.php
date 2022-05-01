
<?php
    use App\Models\Nowemotion;

    $nowEmotionData = new Nowemotion();
    $emotionData = $nowEmotionData->nowEmotionModelGet();

    $count = array();
    $data = array();
    foreach ($emotionData as $emotion) {
        array_push($count,$emotion->sequenceid);
        array_push($data,$emotion->nowemotion);
    }
    $countData = array_count_values($count);

    $column = 0;
    for ($j = 1;$j <= count($countData);$j++) {

        $tmp = array();
        $tmpData = array();
        $tmpKeyStr = array();
        for ($k = $column;$k < ($column+$countData[$j]);$k++) {
            $tmpData[$k-$column] = $data[$k]; 
        }

        for ($i = 0;$i < $countData[$j];$i++) {
            array_push($tmp,$tmpData[$i]);
        }

        for ($i = 0;$i < $countData[$j];$i++) {
            $l = $i + 1;
            $tmpKeyStr[$l] = $tmp[$i];
        }

        $emotionArray[$j] = $tmpKeyStr;
        $column = $column + $countData[$j];
    }

    for ($i = 1;$i <= count($emotionArray);$i++) {
        $question['question'.$i] = array_slice($emotionArray[$i],0,1);
        $answer['answer'.$i][$i-1] = array_slice($emotionArray[$i],1);
        $emotions[$i]['question'] = $question['question'.$i];
        $emotions[$i]['answer'][0] = $answer['answer'.$i][$i-1];
    }

?>

    <div class="container">
        <h6 class="modal-title" id="exampleModalLabel">今日もお疲れ様。あなたの今の気持ちを聞かせてね。(サイト訪問時間でコメント変える)</h6>
        <div class="modal-body">
            @for ($i = 1;$i <= count($emotions);$i++)
                <h4 class="card-title text-left mb-4 mt-1">{{ $emotions[$i]['question'][0] }}</h4>
                @for ($j = 0;$j < count($emotions[$i]['answer'][0]);$j++)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="emotionsData[]" id="emotionId">
                        <label class="form-check-label" for="emotion">{{ $emotions[$i]['answer'][0][$j] }}</label>
                    </div>
                @endfor
            @endfor
        </div>
        <div class="modal-footer">
            <button type="submit" class="btn btn-primary btn-block">決定</button>
            <p class="text-center" data-modal="close"><a href="#" class="btn">閉じる</a></p>
        </div> 
    </div>

