
<?php
    $title = '管理者権限付与ページ';
?>

@include('include.header')

    @include('block.title')

        <strong class="text-muted">メールアドレス</strong>
        <div class="form-group">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text"><i class="fa fa-user"></i></span>
                </div>
                <input class="form-control @if($errors->has('email')) is-invalid @endif" placeholder="メールアドレス" id="email" data-whatever="{{ old('email') }}" name="email" value="{{ old('email') }}" required>
                @if($errors->has('email'))
                    <div class="invalid-feedback">{{ $errors->first('email') }}</div>
                @else
                    <div class="invalid-feedback">必須入力です。</div>
                @endif
            </div> 
        </div> 
        <div class="form-group">
            <div class="input-group">
                <p class="text-danger">※管理者権限を付与したいユーザーにお送りしますので、対象ユーザーのメールアドレスを入力してください。</p>
            </div>
        </div>
            
        <div class="form-group">
            <div class="text-center">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#adminlinkconfirm">確認</button>
            </div> 
        </div> 
        <div class="form-group">
            <div class="text-center">
                <a class="btn btn-primary" href="/adminpage" role="button">管理者設定ページへ戻る</a>
            </div>
        </div>

        <div class="modal fade" id="adminlinkconfirm" tabindex="-1" role="dialog" aria-labelledby="adminlinkconfirm" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="modal-title">
                            <div class="text-center">送信確認</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger text-center">こちらのメールアドレスに送信しますが、よろしいですか？</p>
                        <div class="modal-email text-center" id="modal-email"></div>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-around">
                            <button type="submit" class="btn btn-primary" id="submitbutton">送信</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal">キャンセル</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adminlinksuccess" tabindex="-1" role="dialog" aria-labelledby="adminlinksuccess" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="modal-title">
                            <div class="text-center">送信成功</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p class="text-success text-center" id="successmsg"></p>
                        <p class="text-danger text-center">※管理者に指定された利用者がアカウントを作成すると、あなた宛にメールが届き、あなたは管理者ではなくなります。</p>
                    </div>
                    <form action="/adminpage" method="GET">
                        <div class="modal-footer">
                            <div class="d-flex justify-content-around">
                                <button type="submit" class="btn btn-primary" id="successbutton">管理者用ページに戻る</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="adminlinkfail" tabindex="-1" role="dialog" aria-labelledby="adminlinkfail" aria-hidden="true" data-backdrop="static">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <div id="modal-title">
                            <div class="text-center">送信失敗</div>
                        </div>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger text-center">送信失敗しました。再度メールアドレスを入力し、送信してください。</p>
                    </div>
                    <div class="modal-footer">
                        <div class="d-flex justify-content-around">
                            <button type="button" class="btn btn-primary" data-dismiss="modal">確認(モーダル閉じる)</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @include('block.endtitle')
    

<script>
    $('#adminlinkconfirm').on('show.bs.modal', function () {
        var email = $('#email').val() //data-email の値を取得

        var modal = $(this)
        modal.find('.modal-body div#modal-email').text(email)
    })

    //確認用モーダル内の送信ボタンを押下した際の成功、失敗モーダルを決めるJQuery
    $('#submitbutton').click(function() {
        var email = $('#email').val();

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url: "/adminlink/complete",
            type: "post",
            data: {
                email: email
            },
            dataType: "json",

        }).done(function(response) {
            var modal = $("#adminlinksuccess")
            modal.find('.modal-body p#successmsg').text(response["msg"]);
            //メールアドレス送信完了できたら、送信完了用メッセージ表示を付与した完了用のモーダル開く
            $("#adminlinkconfirm").modal();
            $("#adminlinkconfirm").modal("hide");
            $("#adminlinksuccess").modal("show");
        }).fail(function(failresponse) {
            //失敗したら、失敗用のモーダル開く
            $("#adminlinkconfirm").modal();
            $("#adminlinkconfirm").modal("hide");
            $("#adminlinkfail").modal("show");

        })
    })
</script>