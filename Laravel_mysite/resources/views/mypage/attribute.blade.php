<?php
    $title = '個人属性変更';
?>

@include('include.header')

    @include('block.title')

        <form action="/attributecomplete" method="POST">
            @csrf
            @for ($i = 1;$i <= count($attributedata["attributes"]["q_body"]);$i++) 
                <h4>{{ $attributedata["attributes"]["q_body"][$i] }}</h4>
                <div class="attribute-word">
                    @for ($j = 0;$j < count($attributedata["attributes"]["q_attribute"][$i]);$j++)
                        <div class="form-check form-check-inline">
                            @if ($attributedata["attributes"]["type_id"][$i] == 'text')
                                <input type="{{ $attributedata['attributes']['type_id'][$i] }}" id="{{ $attributedata['attributes']['attr_id'][$i][$j] }}" name="{{ $attributedata['attributes']['name_id'][$i] }}" value="{{ $attributedata['attrtext'][$i] }}">
                            @else
                                @if (in_array($attributedata["attributes"]["attr_id"][$i][$j],$attributedata["attrid"]))
                                    <input class="form-check-input" type="{{ $attributedata['attributes']['type_id'][$i] }}" id="{{ $attributedata['attributes']['attr_id'][$i][$j] }}" name="{{ $attributedata['attributes']['name_id'][$i] }}" value="{{ $attributedata['attributes']['attr_id'][$i][$j] }}" checked>
                                    <label class="form-check-label" for="{{ $attributedata['attributes']['attr_id'][$i][$j] }}">{{ $attributedata["attributes"]["q_attribute"][$i][$j] }}</label>
                                @else
                                    <input class="form-check-input" type="{{ $attributedata['attributes']['type_id'][$i] }}" id="{{ $attributedata['attributes']['attr_id'][$i][$j] }}" name="{{ $attributedata['attributes']['name_id'][$i] }}" value="{{ $attributedata['attributes']['attr_id'][$i][$j] }}">
                                    <label class="form-check-label" for="{{ $attributedata['attributes']['attr_id'][$i][$j] }}">{{ $attributedata["attributes"]["q_attribute"][$i][$j] }}</label>
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