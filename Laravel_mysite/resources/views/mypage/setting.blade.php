
<?php
    $title = '詳細設定';
?>

@include('include.header')

    @include('block.title')

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#rankingdisplay" class="nav-link active" data-toggle="tab">ランキング表示設定</a>
            </li>
            <li class="nav-item">
                <a href="#comictable" class="nav-link" data-toggle="tab">ランキング表示</a>
            </li>
            <li class="nav-item">
                <a href="#animetable" class="nav-link" data-toggle="tab">ランキング</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="rankingdisplay" class="tab-pane active">
                <div class="setting-attribute-word">
                    <div class="form-check form-check-inline">
                        @for ($i = 0;$i < count($attributeq);$i++) 
                            @if ($rankingtablist[$i] == 1)
                                <input class="form-check-input" type="checkbox" id="{{ $attributeattrid[$i] }}" name="tabledisplayflag" value="{{ $attributeattrid[$i] }}" checked>
                                <label class="form-check-label" for="{{ $attributeattrid[$i] }}">{{ $attributeq[$i] }}</label>
                            @else
                                <input class="form-check-input" type="checkbox" id="{{ $attributeattrid[$i] }}" name="tabledisplayflag" value="{{ $attributeattrid[$i] }}">
                                <label class="form-check-label" for="{{ $attributeattrid[$i] }}">{{ $attributeq[$i] }}</label>
                            @endif
                        @endfor
                    </div>
                </div>
                <div class="setting-attribute-word">
                    <div class="form-check form-check-inline">
                        @for ($i = 0;$i < count($tablesetting);$i++)
                            @if ($defaulttablesetting == $tablesetting[$i])
                                <input class="form-check-input" type="radio" id="{{ $firstdisplayflag[$i] }}" name="firsttitledisplayflag" value="{{ $firstdisplayflag[$i] }}" checked>
                                <label class="form-check-label" for="{{ $firstdisplayflag[$i] }}">{{ $tablesetting[$i] }}</label>
                            @else
                                <input class="form-check-input" type="radio" id="{{ $firstdisplayflag[$i] }}" name="firsttitledisplayflag" value="{{ $firstdisplayflag[$i] }}">
                                <label class="form-check-label" for="{{ $firstdisplayflag[$i] }}">{{ $tablesetting[$i] }}</label>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>
            <div id="comictable" class="tab-pane">
                設定です。
            </div>
            <div id="animetable" class="tab-pane">
                設定です。
            </div>
        </div>

        <div class="modal fade" id="settingsuccess" tabindex="-1" role="dialog" aria-labelledby="settingsuccess" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="modal-title">
                            <div class="text-center">設定変更完了</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p class="text-success text-center" id="settingsuccessmsg"></p>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-around">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="settingfail" tabindex="-1" role="dialog" aria-labelledby="settingfail" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="modal-title">
                            <div class="text-center">設定変更失敗</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger text-center" id="settingfailmsg"></p>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-around">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group">
            <div class="text-center">
                <button type="submit" class="btn btn-primary btn-block" id="settingsetting">変更</button>
            </div> 
        </div> 
        <div class="form-group">
            <div class="text-center">
                <a class="btn btn-primary" href="/mypage" role="button">戻る</a>
            </div>
        </div>

    @include('block.endtitle')

@include('include.footer')
   
<script>
    $('#settingsetting').click(function() {

        var gettabletab = document.getElementsByName("tabledisplayflag");
        var gettabletitle = document.getElementsByName('firsttitledisplayflag');

        tablist = [];
        for (let i = 0; i < gettabletab.length; i++) {
            if (gettabletab[i].checked) {
                tablist.push(1);
            } else {
                tablist.push(0);
            }
        } 

        tabidlist = [];
        for (let i = 0; i < gettabletab.length; i++) {
            tabidlist.push(gettabletab[i].value);
        } 

        tablelist = [];
        for (let i = 0; i < gettabletitle.length; i++) {
            if (gettabletitle[i].checked) tablelist.push(gettabletitle[i].value);
        }    

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/mypage/setting",
            type: "post",
            data: {
                tab: tablist,
                tabid: tabidlist,
                table: tablelist[0],
            },
            dataType: "json",

        }).done(function(response) {
            var modal = $("#settingsuccess")
            modal.find('.modal-body p#settingsuccessmsg').text(response["msg"]);
            $("#settingsuccess").modal("show");
    
        }).fail(function(failresponse) {
            var modal = $("#settingfail")
            modal.find('.modal-body p#settingfailmsg').text("変更できませんでした。");
            //失敗したら、失敗用のモーダル開く
            $("#settingfail").modal("show");
        })
    })

</script>