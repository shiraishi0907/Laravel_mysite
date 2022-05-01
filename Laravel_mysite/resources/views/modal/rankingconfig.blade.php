
<div class="row">
    <div class="col text-center">
        <div class="rankingconfig-word">
            @for ($j = 0;$j < count($attributes["q_attribute"][$i]);$j++)
                <div class="rank-class">
                    <div class="form-check">
                        @if ($attributes['type_id'][$i] != 'text')
                            <label class="form-check-label" for="{{ $attributes['attr_id'][$i][$j] }}">
                            <input class="form-check-input checkattr{{ $i }}" type="{{ $attributes['type_id'][$i] }}" id="{{ $attributes['attr_id'][$i][$j] }}" name="{{ $attributes['name_id'][$i] }}" value="{{ $attributes['attr_id'][$i][$j] }}" onclick="chkButton('check{{ $i }}')">
                            &nbsp;
                            &nbsp;
                            {{ $attributes["q_attribute"][$i][$j] }}</label>
                        @else
                            <div class="form-group">
                                <input class="form-control" type="{{ $attributes['type_id'][$i] }}" id="{{ $attributes['attr_id'][$i][$j] }}">
                            </div>
                        @endif
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="col text-center">
        @if ($i != 1)
            @include('modal.modalbuttonprevious')
        @else
            @include('modal.modalbuttonempty')
        @endif
        @if ($i != count($attributes["q_explain"]))
            @include('modal.modalbuttonnext')
        @else
            @include('modal.modalbuttoncomplete')
        @endif
    </div>
</div>

<div class="modal-class" id="modalcomplete">
    <div class="modal-header">
        登録完了
    </div>
    <div class="modal-body">
        登録、ありがとうございます。変更したい場合は、マイページから変更してください。
    </div>
    <div class="modal-footer">
        <button id="modalcompletebutton" type="button" class="btn btn-primary btn-lg" data-dismiss="modal">閉じる</button>
    </div>
</div>
    
<script>
    var contentstopmodals = <?php $attributes;?>

    /*
     * 質問モーダルの2つ目以降は非表示 
     */
    $('#show1').show();
    for(let i = 2;i <= 4;i++) {
        $('#show' + i).hide();
    }
    $('#modalcomplete').hide();

    /**
     * 次へボタンを初期非表示
     */
    for (let i = 1;i <= 4;i++) {
        $('#idnext' + i + '').hide();
    }
    
    $(function() {
        /*
         * 次へボタン押下で、次の質問モーダル表示 
         */
        for(let i = 1;i < 4;i++) {    
            $('#idnext' + i + '').click(function() {
                $('.modal-class').not($(this).attr('id')).hide();
                $('#show' + (i+1)).show();
            })
        }

        /*
         * 前へボタン押下で、前の質問モーダル表示 
         */
        for(let i = 4;i > 1;i--) {    
            $('#idprevious' + i + '').click(function() {
                $('.modal-class').not($(this).attr('id')).hide();
                $('#show' + (i-1)).show();
            })
        }
    })

    /*
     * 何かしらの質問チェックで次へボタンを出現
     */ 
    function chkButton($chk) {
        for (i = 1;i <= 4;i++) {
            if ($chk == 'check' + i) {
                chkList = [];
                let getCheck = document.getElementsByClassName('checkattr' + i);
                for (let i = 0; i < getCheck.length; i++) {
                    if (getCheck[i].checked) {
                        chkList.push(getCheck[i].id);
                    }
                }   
                if (chkList.length > 0) {
                    $('#idnext' + i + '').show();
                } else {
                    $('#idnext' + i + '').hide();
                }
            }
        }
    }

    
    $('.completebutton').click(function() {
        let getradio = $("input[type='radio']").filter(":checked");
        let getcheck = $("input[type='checkbox']").filter(":checked");
        let gettext = $("input[type='text']");

        getchecklist = [];
        gettypelist = [];
        gettextidlist = [];
        for (let i = 0; i < getradio.length; i++) {
            getchecklist.push(getradio[i].value);
            gettypelist.push(1);
            gettextidlist.push("NONE");
        } 
        for (let i = 0; i < getcheck.length; i++) {
            getchecklist.push(getcheck[i].value);
            gettypelist.push(2);
            gettextidlist.push("NONE");
        }   
        for (let i = 0; i < gettext.length; i++) {
            getchecklist.push(gettext[i].id);
            gettypelist.push(3);
            gettextidlist.push(gettext[i].value);
        }   

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            //DBから検索結果を取得
            url: "/modal/complete",
            type: "post",
            data: {
                modals: getchecklist,
                type: gettypelist,
                id: gettextidlist
            },
            dataType: "json",
        }).done( function() {
            $('.modal-class').not($(this).attr('id')).hide(); //ここおかしい(完了モーダルが出ない)
            $('#modalcomplete').show();
        }).fail( function() {
            console.log("エラー");
        })
    })

    //$('#datepicker').datepicker();

    var gettext = document.querySelector('[id = "datepicker"]');

    //イベントリスナーを登録 changeはテキストからフォーカスが外れた時に発生、inputはテキストに値を入れるたびに発生
    gettext.addEventListener("input",function(){
        if (this.value.length > 0) {
            $('#idnext2').show(); 
        } else {
            $('#idnext2').hide(); 
        }
    });
</script>
