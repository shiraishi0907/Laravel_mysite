<?php
    $title = 'アカウント設定';
?>

@include('include.header')

    @include('block.title')

        <strong class="text-muted">管理者ニックネーム</strong>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input class="form-control" id="adminnickname" placeholder="管理者ニックネーム" type="text" name="adminnickname" value="{{ $nickname }}">
            </div> 
        </div> 
        <strong class="text-muted">管理者ログインID</strong>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input class="form-control" id="adminloginid" placeholder="管理者ログインID" type="text" name="adminloginid" value="{{ $loginid }}" readonly>
            </div> 
        </div> 
        <strong class="text-muted">管理者Eメールアドレス</strong>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input class="form-control" id="adminemail" placeholder="管理者Eメールアドレス" type="text" name="adminemail" value="{{ $email }}">
            </div> 
        </div> 
        
        <div class="modal fade" id="adminaccountsuccess" tabindex="-1" role="dialog" aria-labelledby="adminaccountsuccess" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="modal-title">
                            <div class="text-center">設定変更完了</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p class="text-success text-center" id="adminaccountsuccessmsg"></p>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-around">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">閉じる</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adminaccountfail" tabindex="-1" role="dialog" aria-labelledby="adminaccountfail" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="modal-title">
                            <div class="text-center">設定変更失敗</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger text-center" id="adminaccountfailmsg"></p>
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
            <button type="button" class="btn btn-primary btn-block" id="adminaccountsetting">設定</button>
            <input type="hidden" name="register" value="user">
        </div> 
        <div class="form-group">
            <div class="text-center">
                <a class="btn btn-primary" href="/adminpage" role="button">戻る</a>
            </div>
        </div>
    
    @include('block.endtitle')


<script>
    $('#adminaccountsetting').click(function() {
        var nickname = $('#adminnickname').val();
        var loginid = $('#adminloginid').val();
        var email = $('#adminemail').val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/adminaccount/setting",
            type: "post",
            data: {
                nickname: nickname,
                loginid: loginid,
                email: email
            },
            dataType: "json",

        }).done(function(response) {
            var modal = $("#adminaccountsuccess")
            modal.find('.modal-body p#adminaccountsuccessmsg').text(response["msg"]);
            //メールアドレス送信完了できたら、送信完了用メッセージ表示を付与した完了用のモーダル開く
            $("#adminnickname").val(response["users"][0]["nickname"]);
            $("#adminloginid").val(response["users"][0]["loginid"]);
            $("#adminemail").val(response["users"][0]["email"]);
            $("#adminaccountsuccess").modal("show");
        }).fail(function(failresponse) {
            var modal = $("#adminaccountfail")
            modal.find('.modal-body p#adminaccountfailmsg').text("登録できませんでした。");
            //失敗したら、失敗用のモーダル開く
            $("#adminaccountfail").modal("show");
        })
    })
</script>