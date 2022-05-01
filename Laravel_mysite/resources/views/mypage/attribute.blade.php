<?php
    $title = '個人属性変更';
?>

@include('include.header')

    @include('block.title')

        <form action="/mypage" method="POST">
            @for ($i = 1;$i <= count($attributes["q_body"]);$i++) 
                <h4>{{ $attributes["q_body"][$i] }}</h4>
                <div class="attribute-word">
                    @for ($j = 0;$j < count($attributes["q_attribute"][$i]);$j++)
                        <div class="form-check form-check-inline">
                            @if ($attributes["type_id"][$i] == 'text')
                                <input type="{{ $attributes['type_id'][$i] }}" id="{{ $attributes['attr_id'][$i][$j] }}" value='{{ $attributes["q_attribute"][$i][$j] }}'>
                            @else
                                @if (in_array($attributes['attr_id'][$i][$j],$attrid))
                                    <input class="form-check-input" type="{{ $attributes['type_id'][$i] }}" id="{{ $attributes['attr_id'][$i][$j] }}" name="{{ $attributes['name_id'][$i] }}" checked>
                                    <label class="form-check-label" for="{{ $attributes['attr_id'][$i][$j] }}">{{ $attributes["q_attribute"][$i][$j] }}</label>
                                @else
                                    <input class="form-check-input" type="{{ $attributes['type_id'][$i] }}" id="{{ $attributes['attr_id'][$i][$j] }}" name="{{ $attributes['name_id'][$i] }}">
                                    <label class="form-check-label" for="{{ $attributes['attr_id'][$i][$j] }}">{{ $attributes["q_attribute"][$i][$j] }}</label>
                                @endif
                            @endif
                        </div>
                    @endfor
                </div>
            @endfor

            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">変更</button>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/mypage" role="button">戻る</a>
                </div>
            </div>
        </form>

    @include('block.endtitle')

@include('include.footer')

<script>
    $(function() {
        $('#datepicker').datepicker({
            dateFormat: 'yy-mm-dd D',
            showAnim: 'bounce',
            changeYear: true,  // 年選択プルダウン
            hangeMonth: true  
        });  
    });
</script>