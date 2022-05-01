<?php
    $title = '統計情報';
?>

@include('include.header')

    @include('block.title')

        <div class="row">
            <div class="col">
                <?php
                    $title = 'あなたがよく閲覧するジャンル';
                ?>
                @include('block.statisticstitle')
                    @include('block.statisticsinnertitle')
                        @for ($i = 1;$i <= 3;$i++)
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <strong class="columnrankname">{{ $i }}位</strong>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <strong class="columnrank">ジャンル名</strong>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        @endfor
                    @include('block.statisticsinnerendtitle')
                @include('block.statisticsendtitle')
            </div>
            <div class="col">
                <?php
                    $title = 'あなたのランキングによく出てくる作品';
                ?>
                @include('block.statisticstitle')
                    @include('block.statisticsinnertitle')
                        @for ($i = 1;$i <= 3;$i++)
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <strong class="columnrankname">{{ $i }}位</strong>
                                        </div>
                                    </div>
                                </div> 
                                <div class="col">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <strong class="columnrank">ジャンル名</strong>
                                        </div>
                                    </div>
                                </div> 
                            </div>
                        @endfor
                    @include('block.statisticsinnerendtitle')
                @include('block.statisticsendtitle')
            </div>
        </div>    
        <div class="row">
            <div class="col">
                <?php
                    $title = 'ログイン時間の遷移';
                ?>
                @include('block.statisticstitle')
                    @include('block.statisticsinnertitle')
                        aaa
                    @include('block.statisticsinnerendtitle')
                @include('block.statisticsendtitle')
            </div>
            <div class="col">
                <?php
                    $title = 'アドバイス';
                    $img_url = asset('assets/img/icon/mypage/statistics/happy.png');
                ?>
                @include('block.statisticstitle')
                    @include('block.statisticsadvicetitle')
                        aaa
                    @include('block.statisticsadviceendtitle')
                @include('block.statisticsendtitle')
            </div>
        </div>    
        <div class="form-group">
            <div class="text-left">
                <a class="btn btn-primary" href="/mypage" role="button">戻る</a>
            </div>
        </div> 

    @include('block.endtitle')

@include('include.footer')

