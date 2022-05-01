<?php
    $title = 'マイページ';
?>

@include('include.header')

    @include('block.title')

        <div class="row" id="mypage1">
            <div class="col">
                <?php
                    $title = 'ユーザー情報変更';
                    $img_url = asset('assets/img/icon/mypage/home/account.png');
                ?>
                <a href="#" id="moveuserinfo">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        ニックネーム・パスワードの<br>変更はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = '個人属性変更';
                    $img_url = asset('assets/img/icon/mypage/home/attribute.png');
                ?>
                <a href="/attribute">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        あなたへのおすすめの作品の<br>設定はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = '会員情報';
                    $img_url = asset('assets/img/icon/mypage/home/userinfo.png');
                ?>
                <a href="/info">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        現在のあなたの<br>会員情報はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
        </div>
        <div class="row" id="mypage2">
            <div class="col">
                <?php
                    $title = '統計情報';
                    $img_url = asset('assets/img/icon/mypage/home/statistics.png');
                ?>
                <a href="/stat">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        あなたの閲覧作品の<br>傾向はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = '閲覧履歴';
                    $img_url = asset('assets/img/icon/mypage/home/viewhistory.png');
                ?>
                <a href="/work_history">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        閲覧した作品の<br>履歴一覧はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = '詳細設定';
                    $img_url = asset('assets/img/icon/mypage/home/indetail.png');
                ?>
                <a href="/setting">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        ランキングなどの<br>各設定はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
        </div>   

        <div class="row" id="userinfo">
            <div class="col">
                <?php
                    $title = 'ニックネーム変更';
                    $img_url = asset('assets/img/icon/mypage/home/nickname.png');
                ?>
                <a href="/nickname_change">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        ニックネームの変更はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = 'パスワード変更';
                    $img_url = asset('assets/img/icon/mypage/home/password.png');
                ?>
                <a href="/passwd_change">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        パスワードの変更はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
        </div>    
        <div class="form-group" id="backmypage">
            <div class="text-left">
                <a class="btn btn-primary" href="/mypage" role="button">戻る</a>
            </div>
        </div> 

    @include('block.endtitle')

@include('include.footer')


<script>
    $(function() {
        $('#userinfo').hide();
        $('#backmypage').hide();

        $('#moveuserinfo').click(function() {
            $('#userinfo').show();
            $('#backmypage').show();
            $('#mypage1').hide();
            $('#mypage2').hide();
        })
    })
</script>