<?php
    //$title = '「'.$workname.'」作品詳細';
    $title = '作品詳細';
    $bigUrl = "http://127.0.0.1/";
    $img = $bigUrl .= $workdata['img'];

    /**
     * get genre from url
     */
    $url = url()->current();
    $genre = explode('/',$url);
    //$genre = $genre[4];
?>

@include('include.header')

    @include('block.title')

        <div class="row">
            <div class="col">
                <?php
                    $title = '作品情報';
                ?>
                @include('block.workindetailtitle')
                    <div class="row">
                        <div class="d-flex text-center">
                            <div class="thumbnailpic">
                                <img src="{{ $img }}" width="200" height="150">
                                <div class="worktitle">
                                    {{ $workdata['title'] }}
                                </div>
                            </div>
                            <div class="explain-favoritebtn">
                                <div class="explain">
                                    {{ $workdata['explaining'] }}
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col table-category">
                            <table border="1" width="200" height="60">
                                <tr>
                                    <td>かっこいい</td>
                                    <td>美しい</td>
                                </tr>
                                <tr>
                                    <td>悲哀</td>
                                    <td>心苦しい</td>
                                </tr>
                            </table>
                        </div>
                        <br>
                        <div class="col eachbtn">
                            <div class="form-group">
                                <div class="text-center">
                                    <button type="submit" class="{{ $favoriteclass }}" id="favoritebutton">{{ $favoritetext }}</button>
                                </div> 
                            </div> 
                            <div class="form-group">
                                <div class="text-center">
                                    <a href="/genrepost"><button type="submit" class="btn btn-primary btn-block">ジャンル投票</button></a>
                                </div> 
                            </div> 
                        </div>
                    </div>
                @include('block.workindetailendtitle')
            </div>
            <div class="col">
                <?php
                    $title = 'ログイン回数';
                ?>
                @include('block.workindetailtitle')
                    <div class="card">
                        <div class="card-body">
                            <canvas id="goodtimescanvas"></canvas>
                        </div>
                    </div>
                    <br>
                    <?php
                        $amazon = asset('assets/img/icon/workindetail/amazonprime.png');
                        $yahoo = asset('assets/img/icon/workindetail/yahoo.png');
                    ?>
                    <div class="row">
                        <div class="col icon-otherpage">
                            <a href="#"><img src="{{ $amazon }}" width="75" height="50" alt="amazon prime"></a>
                            <span class="icontitle">Amazon Prime</span>
                        </div>
                        <div class="col icon-otherpage">
                            <a href="#"><img src="{{ $yahoo }}" width="75" height="50" alt="yahoo calender"></a>
                            <span class="icontitle">Yahoo Calender</span>
                        </div>
                    </div>
                @include('block.workindetailendtitle')
            </div>
        </div>
        <div class="row">
            <div class="col">
                <?php
                    $title = 'レビュー';
                ?>
                @include('block.workindetailtitle')
                    <?php
                        $rankingtitleleft = '';
                        $rankingtitleright = '';
                        $rankingtitle = 'レビュー投稿する';
                    ?>
                    @include('block.workindetail_reviewtitle')
                    @include('block.workindetail_reviewendtitle')

                    @if (count($workdata['posts']) != 0)
                        @foreach ($workdata['posts'] as $post)
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            {{ $post->loginid }}
                                        </div>
                                        <div class="col">
                                            レビュータイトル
                                        </div>
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                    <div class="row">
                                        <div class="col">
                                            {{ $post->poststar }}
                                        </div>
                                        <div class="col">
                                            {{ $post->postbody }}
                                        </div>
                                        <div class="col">
                                            いいね
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br>
                        @endforeach
                    @else 
                        <div class="nopost">
                            レビューはありません。
                        </div>
                    @endif
                @include('block.workindetailendtitle')
            </div>
        </div>
    
    @include('block.endtitle')

@include('include.footer')

<script>
    $('#favoritebutton').click(function() {
        var chgbutton = document.getElementById('favoritebutton');
        var getregistersrc = location.pathname;
        var getregistertitle = document.getElementsByClassName('worktitle');

        if (chgbutton.className == 'btn btn-primary btn-block') {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/workindetail/favorite/add",
                type: "post",
                data: {
                    url: getregistersrc,
                    title: getregistertitle[0].innerText
                },
                dataType: "json",

            }).done(function(response) {
                chgbutton.className = 'btn btn-secondary btn-block';
                chgbutton.innerText = 'お気に入りに登録済み';

            }).fail(function(failresponse) {
            })
        } else {
            $.ajax({
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url: "/workindetail/favorite/delete",
                type: "post",
                data: {
                    url: getregistersrc,
                    title: getregistertitle[0].innerText
                },
                dataType: "json",

            }).done(function(response) {
                chgbutton.className = 'btn btn-primary btn-block';
                chgbutton.innerText = 'お気に入りに登録';
            }).fail(function(failresponse) {
            })
        }
    })
</script>

<script>
    var goodtimescanvas = document.getElementById('goodtimescanvas').getContext('2d');
    var myChart = new Chart(goodtimescanvas, {
        type: 'bar',
        data: {
            labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
            datasets: [{
                label: 'ログイン回数',
                data: [12, 19, 3, 17, 6, 3, 7, 8, 1, 2, 3],
                backgroundColor: "rgba(23,15,151,0.4)"
            }]
        }
    });
</script>