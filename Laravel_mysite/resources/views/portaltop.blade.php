<?php
    $title = 'トップページ';
?>

@include('include.header')

<div class="p-3 mb-2 bg-secondary text-white">
    <div class="container">
        <h3 class="my-3">新着情報</h3>
        <div class="carousel slide" id="sample" data-ride="carousel">
            <ol class="carousel-indicators">
                <!--<li data-target="#sample" data-slide-to="0" class="active"></li>
                <li data-target="#sample" data-slide-to="1"></li>
                <li data-target="#sample" data-slide-to="2"></li>-->
            </ol>
            <!--<div class="carousel-inner carousel-fade">
                <div class="carousel-item active">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($filmData as $film)
                            @if($i == 1)
                                <div class="col">
                                    <img src="{{ $film->filmpicture }}" alt="{{ $film->filmname }}" width="530" height="400">
                                </div>
                                <div class="col">
                                    <h3>{{ $film->filmname }}</h3>
                                </div>
                            @endif
                        <?php $i++ ?>
                        @endforeach
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($comicData as $comic)
                            @if($i == 1)
                                <div class="col">
                                    <img src="{{ $comic->comicpicture }}" alt="{{ $comic->comicname }}">
                                </div>
                                <div class="col">
                                    <h3>{{ $comic->comicname }}</h3>
                                </div>
                            @endif
                        <?php $i++ ?>
                        @endforeach
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <?php $i = 1; ?>
                        @foreach($animeData as $anime)
                            @if($i == 1)
                                <div class="col">
                                    <img src="{{ $anime->animepicture }}" alt="{{ $anime->animename }}" width="530" height="400">
                                </div>
                                <div class="col">
                                    <h3>{{ $anime->animename }}</h3>
                                </div>
                            @endif
                        <?php $i++ ?>
                        @endforeach
                    </div>
                </div>
            </div>
            <a href="#sample" class="carousel-control-prev" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
                <span class="sr-only">前の画像へ</span>
            </a>
            <a href="#sample" class="carousel-control-next" data-slide="next">
                <span class="carousel-control-next-icon"></span>
                <span class="sr-only">次の画像へ</span>
            </a>
        </div>
    </div>
</div>

<div class="container">
    <div class="row my-3" id="openModal">
        <h1>モーダルを開く</h1>
    </div>
    <div class="row mb-5">
        <div class="col-2">
            <button type="button" class="btn btn-primary mb-12" data-toggle="modal" data-target="#nowEmotionModal">ボタンで開く</button>
        </div>
        <div class="col-2">
            <a class="btn btn-primary" data-toggle="modal" data-target="#testModal">リンクボタンで開く</a>
        </div>
    </div>
</div>-->


<!-- ボタン・リンククリック後に表示される画面の内容 -->
<div class="modal fade" id="nowEmotionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="parent" style="margin-top:30px;">
                <div class="modal-header">
                    @include('nowemotion')
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <article class="card-body">
        <h2 class="card-title text-center mb-4 mt-1">XXXXXX サイトとは</h2>
        <div class="d-flex text-center justify-content-center">
            お家で何を見よう？自分にとってのおすすめの映画、おすすめの漫画、おすすめのアニメって何だろう？そんな疑問はありませんか？<br>
            本サイトは自分がどんなアニメ、漫画、映画を見たいかのおすすめを教えてくれるサイトです。<br>
            さらに、見た作品について「ここが面白い！」という感想があれば、「レビュ-投稿する」でレビュー投稿して、<br>
            その作品の面白さを他のユーザーに端的に知らせてあげよう！ネタバレはやめてね！<br>
            今週の全ユーザーおすすめランキングには、レビュー投稿された作品の面白度合いをポイント化してランキングを表示するよ！<br>
            あなたのおすすめランキングには、自分が気になるタグを設定しておくと、それに応じたおすすめランキングを表示するよ！
        </div>
    </article>

    <div class="text-center">
        <a href="/post" class="btn btn-secondary">レビュー投稿する</a>
    </div>
    

    <article class="card-body card">
        <h2 class="card-title text-center mb-4 mt-1">今週の全ユーザーおすすめランキング</h2>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#filmtable" class="nav-link active" data-toggle="tab">映画</a>
            </li>
            <li class="nav-item">
                <a href="#comictable" class="nav-link" data-toggle="tab">漫画</a>
            </li>
            <li class="nav-item">
                <a href="#animetable" class="nav-link" data-toggle="tab">アニメ</a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="filmtable" class="tab-pane active">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">Rank</th>
                            <th class="align-middle">作品画像</th>
                            <th class="align-middle">作品名</th>
                            <th class="align-middle">ポイント</th>
                            <th class="align-middle">前回の順位</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <!--@foreach($filmData as $film)
                        <tbody>
                            <tr>
                                <th class="rank{{ $i }} align-middle">{{ $i }}</th>
                                <td class="align-middle"><a href="/work_indetail/{{ $film->filmslug }}" target="_blank" rel="nofollow noopener"><img src="{{ $film->filmpicture }}" alt="{{ $film->filmname }}" width="120" height="80"></a></td>
                                <td class="align-middle">{{ $film->filmname }}</td>
                                <td class="align-middle">point</td>
                                <td class="align-middle">3 ↑</td>
                            </tr>
                        </tbody>
                    <?php $i++ ?>
                    @endforeach-->
                </table>
            </div>
            <div id="comictable" class="tab-pane">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">Rank</th>
                            <th class="align-middle">作品画像</th>
                            <th class="align-middle">作品名</th>
                            <th class="align-middle">ポイント</th>
                            <th class="align-middle">前回の順位</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <!--@foreach($comicData as $comic)
                        <tbody>
                            <tr>
                                <th class="rank{{ $i }} align-middle">{{ $i }}</th>
                                <td class="align-middle"><a href="/work_indetail/{{ $comic->comicslug }}" target="_blank" rel="nofollow noopener"><img src="{{ $comic->comicpicture }}" alt="{{ $comic->comicname }}" width="60" height="80"></a></td>
                                <td class="align-middle">{{ $comic->comicname }}</td>
                                <td class="align-middle">point</td>
                                <td class="align-middle">3 ↑</td>
                            </tr>
                        </tbody>
                    <?php $i++ ?>
                    @endforeach-->
                </table>
            </div>
            <div id="animetable" class="tab-pane">
                <table class="table table-sm">
                    <thead class="thead-dark">
                        <tr>
                            <th class="align-middle">Rank</th>
                            <th class="align-middle">作品画像</th>
                            <th class="align-middle">作品名</th>
                            <th class="align-middle">ポイント</th>
                            <th class="align-middle">前回の順位</th>
                        </tr>
                    </thead>
                    <?php $i = 1; ?>
                    <!--@foreach($animeData as $anime)
                        <tbody>
                            <tr>
                                <th class="rank{{ $i }} align-middle">{{ $i }}</th>
                                <td class="align-middle"><a href="/work_indetail/{{ $anime->animeslug }}" target="_blank" rel="nofollow noopener"><img src="{{ $anime->animepicture }}" alt="{{ $anime->animename }}" width="120" height="80"></a></td>
                                <td class="align-middle">{{ $anime->animename }}</td>
                                <td class="align-middle">point</td>
                                <td class="align-middle">3 ↑</td>
                            </tr>
                        </tbody>
                    <?php $i++ ?>
                    @endforeach-->
                </table>
            </div>
        </div>
    </article>

    <article class="card-body card">
        <h2 class="card-title text-center mb-4 mt-1">あなたのおすすめランキング</h2>
        <?php $film = "映画"; ?>
        <?php $comic = "漫画"; ?>
        <?php //$anime = "アニメ"; ?>
        @empty(session('loginid')) <!--ログインしていない人-->
            <div class="d-flex justify-content-center">
                ログインしてください。
            </div>
            <div class="form-group text-center">
                <a href="/login" class="btn btn-primary">ログイン</a>
            </div> 
        @else
            @empty($film) <!--ログインしているが、ジャンルを設定していない人-->
                <div class="d-flex justify-content-center">
                    知りたいランキングのジャンルを設定してください。
                </div>
                <div class="form-group text-center">
                    <a href="/post" class="btn btn-primary">ジャンルを設定する</a>
                </div> 
            @else <!--ログインしていて、ジャンルも設定している人-->
                <ul class="nav nav-tabs">
                    @isset($film)
                        <li class="nav-item">
                            <a href="#recommendfilmtable" class="nav-link" data-toggle="tab">映画</a>
                        </li>
                    @endisset
                    @isset($comic)
                        <li class="nav-item">
                            <a href="#recommendcomictable" class="nav-link" data-toggle="tab">漫画</a>
                        </li>
                    @endisset
                    @isset($anime)
                        <li class="nav-item">
                            <a href="#recommendanimetable" class="nav-link" data-toggle="tab">アニメ</a>
                        </li>
                    @endisset
                </ul>
                
                <div class="tab-content">
                @isset($film)
                    <div id="recommendfilmtable" class="tab-pane active">
                        <table class="table table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="align-middle">Rank</th>
                                    <th class="align-middle">作品画像</th>
                                    <th class="align-middle">作品名</th>
                                    <th class="align-middle">前回の順位</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <!--@foreach($filmData as $film)
                                <tbody>
                                    <tr>
                                        <th class="rank{{ $i }} align-middle">{{ $i }}</th>
                                        <td class="align-middle"><img src="{{ $film->filmpicture }}" alt="{{ $film->filmname }}" width="120" height="80"></td>
                                        <td class="align-middle">{{ $film->filmname }}</td>
                                        <td class="align-middle">5↑</td>
                                    </tr>
                                </tbody>
                            <?php $i++ ?>
                            @endforeach-->
                        </table>
                    </div>
                @endisset
                @isset($comic)
                    <div id="recommendcomictable" class="tab-pane">
                        <table class="table table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="align-middle">Rank</th>
                                    <th class="align-middle">作品画像</th>
                                    <th class="align-middle">作品名</th>
                                    <th class="align-middle">前回の順位</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <!--@foreach($comicData as $comic)
                                <tbody>
                                    <tr>
                                        <th class="rank{{ $i }} align-middle">{{ $i }}</th>
                                        <td class="align-middle"><img src="{{ $comic->comicpicture }}" alt="{{ $comic->comicname }}" width="60" height="80"></td>
                                        <td class="align-middle">{{ $comic->comicname }}</td>
                                        <td class="align-middle">5↑</td>
                                    </tr>
                                </tbody>
                            <?php $i++ ?>
                            @endforeach-->
                        </table>
                    </div>
                @endisset
                @isset($anime)
                    <div id="recommendanimetable" class="tab-pane">
                        <table class="table table-sm">
                            <thead class="thead-dark">
                                <tr>
                                    <th class="align-middle">Rank</th>
                                    <th class="align-middle">作品画像</th>
                                    <th class="align-middle">作品名</th>
                                    <th class="align-middle">前回の順位</th>
                                </tr>
                            </thead>
                            <?php $i = 1; ?>
                            <!--@foreach($animeData as $anime)
                                <tbody>
                                    <tr>
                                        <th class="rank{{ $i }} align-middle">{{ $i }}</th>
                                        <td class="align-middle"><img src="{{ $anime->animepicture }}" alt="{{ $anime->animename }}" width="120" height="80"></td>
                                        <td class="align-middle">{{ $anime->animename }}</td>
                                        <td class="align-middle">5↑</td>
                                    </tr>
                                </tbody>
                            <?php $i++ ?>
                            @endforeach-->
                        </table>
                    </div>
                @endisset
            @endempty
        @endempty
        
    </article>
    <article class="card-body card">
        <h2 class="card-title text-center mb-4 mt-1">あなたが興味のあるジャンル</h2>
        @empty(session('loginid')) <!--ログインしていない人-->
            <div class="d-flex justify-content-center">
                ログインしてください。
            </div>
            <div class="form-group text-center">
                <a href="/login" class="btn btn-primary">ログイン</a>
            </div> 
        @else
            <div class="row">
                <div class="col card">
                    <ul class="nav nav-tabs">
                        @isset($film)
                            <li class="nav-item">
                                <a href="#filmcanvas" class="nav-link" data-toggle="tab" role="tab" aria-controls="film" aria-selected="true">映画</a>
                            </li>
                        @endisset
                        @isset($comic)
                            <li class="nav-item">
                                <a href="#comiccanvas" class="nav-link" data-toggle="tab" role="tab" aria-controls="comic" aria-selected="false">漫画</a>
                            </li>
                        @endisset
                        @isset($anime)
                            <li class="nav-item">
                                <a href="#animecanvas" class="nav-link" data-toggle="tab" role="tab" aria-controls="anime" aria-selected="false">アニメ</a>
                            </li>
                        @endisset
                    </ul>
                    <div class="tab-content">
                        @isset($film)
                            <div id="filmcanvas" class="tab-pane active">
                                <canvas id="filmRadarChart" width="400" height="400"></canvas>
                            </div>
                        @endisset
                        @isset($comic)
                            <div id="comiccanvas" class="tab-pane">
                                <canvas id="comicRadarChart" width="400" height="400"></canvas>
                            </div>
                        @endisset
                        @isset($anime)
                            <div id="animecanvas" class="tab-pane">
                                <canvas id="animeRadarChart" width="400" height="400"></canvas>
                            </div>
                        @endisset
                    </div>
                </div>

                <?php
                    $graph = 0;
                ?>
                <div class="col card">
                    @isset($graph)
                        <canvas id="ex_chart" width="400" height="200"></canvas>
                        <input id="btn" type="button" value="ボタン">
                    @endisset
                </div>
            </div>

            
            
<script>
    var data2 = '{{ $data1 }}';

var ctx = document.getElementById("filmRadarChart");
var myRadarChart = new Chart(ctx, {
  //グラフの種類
  type: 'radar',
  //データの設定
  data: {
      //データ項目のラベル
      labels: ["嬉しさ", "悲しさ", "寂しさ", "評価３", "評価４", "評価5"],
      //データセット
      datasets: [
          {
              label: "〇〇",
              //背景色
              backgroundColor: "rgba(200,112,126,0.5)",
              //枠線の色
              borderColor: "rgba(200,112,126,1)",
              //結合点の背景色
              pointBackgroundColor: "rgba(200,112,126,1)",
              //結合点の枠線の色
              pointBorderColor: "#fff",
              //結合点の背景色（ホバ時）
              pointHoverBackgroundColor: "#fff",
              //結合点の枠線の色（ホバー時）
              pointHoverBorderColor: "rgba(200,112,126,1)",
              //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
              hitRadius: 5,
              //グラフのデータ
              data: [5,3,4,4,data2,7]
          }
      ]
  },
 options: {
    // レスポンシブ指定
    responsive: true,
    scale: {
      ticks: {
        // 最小値の値を0指定
        beginAtZero:true,
        suggestedMin: 0,
        // 最大値を指定
        suggestedMax: 10,
      }
    }
  }
});
</script>


<script>
var ctx = document.getElementById("comicRadarChart");
var myRadarChart = new Chart(ctx, {
  //グラフの種類
  type: 'radar',
  //データの設定
  data: {
      //データ項目のラベル
      labels: ["嬉しさ", "悲しさ", "寂しさ", "評価３", "評価４", "評価5"],
      //データセット
      datasets: [
          {
              label: "〇〇",
              //背景色
              backgroundColor: "rgba(200,112,126,0.5)",
              //枠線の色
              borderColor: "rgba(200,112,126,1)",
              //結合点の背景色
              pointBackgroundColor: "rgba(200,112,126,1)",
              //結合点の枠線の色
              pointBorderColor: "#fff",
              //結合点の背景色（ホバ時）
              pointHoverBackgroundColor: "#fff",
              //結合点の枠線の色（ホバー時）
              pointHoverBorderColor: "rgba(200,112,126,1)",
              //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
              hitRadius: 5,
              //グラフのデータ
              data: [1,8,7,5,data2,7]
          }
      ]
  },
 options: {
    // レスポンシブ指定
    responsive: true,
    scale: {
      ticks: {
        // 最小値の値を0指定
        beginAtZero:true,
        suggestedMin: 0,
        // 最大値を指定
        suggestedMax: 10,
      }
    }
  }
});
</script>
<script>
var ctx = document.getElementById("animeRadarChart");
var myRadarChart = new Chart(ctx, {
  //グラフの種類
  type: 'radar',
  //データの設定
  data: {
      //データ項目のラベル
      labels: ["嬉しさ", "悲しさ", "寂しさ", "評価３", "評価４", "評価5"],
      //データセット
      datasets: [
          {
              label: "〇〇",
              //背景色
              backgroundColor: "rgba(200,112,126,0.5)",
              //枠線の色
              borderColor: "rgba(200,112,126,1)",
              //結合点の背景色
              pointBackgroundColor: "rgba(200,112,126,1)",
              //結合点の枠線の色
              pointBorderColor: "#fff",
              //結合点の背景色（ホバ時）
              pointHoverBackgroundColor: "#fff",
              //結合点の枠線の色（ホバー時）
              pointHoverBorderColor: "rgba(200,112,126,1)",
              //結合点より外でマウスホバーを認識する範囲（ピクセル単位）
              hitRadius: 5,
              //グラフのデータ
              data: [9,7,3,4,data2,7]
          }
      ]
  },
 options: {
    // レスポンシブ指定
    responsive: true,
    scale: {
      ticks: {
        // 最小値の値を0指定
        beginAtZero:true,
        suggestedMin: 0,
        // 最大値を指定
        suggestedMax: 10,
      }
    }
  }
});
</script>

<script>
var chartVal = []; // グラフデータ（描画するデータ）
function getRandom() {
  chartVal = []; // グラフデータを初期化
  var length = 12;
  for (i = 0; i < length; i++) {
    chartVal.push(Math.floor(Math.random() * 20));
  }
  
}

function drawChart() {
    var ctx = document.getElementById('ex_chart').getContext('2d');
  window.myChart = new Chart(ctx, { // インスタンスをグローバル変数で生成
    type: 'line',
    data: { // ラベルとデータセット
      labels: ['January','February','March','April','May','June','July','August','September','October','November','December'],
      datasets: [{
          data: chartVal, // グラフデータ
          backgroundColor: 'rgba(0, 134, 197, 0.7)', // 棒の塗りつぶし色
          borderColor: 'rgba(0, 134, 197, 1)', // 棒の枠線の色
          borderWidth: 1, // 枠線の太さ
      }],
    },
    options: {
      legend: {
        display: false, // 凡例を非表示
      }
    }
  });
}

getRandom();
drawChart(); 

document.getElementById('btn').onclick = function() {
  // すでにグラフ（インスタンス）が生成されている場合は、グラフを破棄する
  if (myChart) {
    myChart.destroy();
  }

  getRandom(); // グラフデータにランダムな値を格納
  drawChart(); // グラフを再描画
}

  


</script>

        @endempty
    </article>

</div>


@include('include.footer')
