<?php
    $title = '管理者設定';
?>

@include('include.header')

    @include('block.title')

        <div class="row" id="adminpage1">
            <div class="col">
                <?php
                    $title = 'ユーザー検索';
                    $img_url = asset('assets/img/icon/admin/adminpage/usersearch.png');
                    $lock_img_url = asset('assets/img/icon/admin/adminimg/lock.png');
                ?>
                <a href="/user_search">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        当サイト利用者ログイン情報<br>確認はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = '管理者ユーザー設定';
                    $img_url = asset('assets/img/icon/admin/adminpage/adminuserset.png');
                ?>
                <a href="/adminlink">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        管理者権限付与用<br>ページはこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = '作品管理';
                    $img_url = asset('assets/img/icon/admin/adminpage/workupload.png');
                ?>
                <a href="#">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        作品の一括管理<br>はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
        </div>
        <div class="row" id="adminpage2">
            <div class="col">
                <?php
                    $title = '各種画面設定';
                    $img_url = asset('assets/img/icon/admin/adminpage/eachset.png');
                ?>
                <a href="/stat">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        各画面設定<br>はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = '各種統計情報';
                    $img_url = asset('assets/img/icon/admin/adminpage/eachinfo.png');
                ?>
                <a href="/stat">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        各利用者の<br>情報はこちら
                    </div>
                @include('block.mypageendtitle')
                </a>
            </div>
            <div class="col">
                <?php
                    $title = 'アカウント設定';
                    $img_url = asset('assets/img/icon/admin/adminpage/mailaddress.png');
                ?>
                <a href="/adminaccount">
                @include('block.mypagetitle')
                    <div class="explanation text-center">
                        管理者の<br>アカウント設定はこちら
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
