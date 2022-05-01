
<?php
    $title = "作品タイトル一覧ページ";
?>

@include('include.header')

<div class="container">
    <article class="card-body">
        <h4 class="card-title text-center mb-4 mt-1">レビュー作品を探す</h4>

        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#workhistory" aria-expanded="false" aria-controls="collapseExample">閲覧履歴から探す</button>
        </div> 
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#search" aria-expanded="false" aria-controls="collapseExample">検索から探す</button>
        </div> 
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#myrecommend" aria-expanded="false" aria-controls="collapseExample">あなたのおすすめランキングから探す</button>
        </div> 
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block" data-toggle="collapse" data-target="#allrecommend" aria-expanded="false" aria-controls="collapseExample">今週のおすすめランキングから探す</button>
        </div> 

        <div class="collapse card" id="workhistory">
            <h4 class="card-title text-center mb-4 mt-1">閲覧履歴</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">画像</th>
                        <th scope="col">作品名</th>
                        <th scope="col">最新閲覧日</th>
                    </tr>
                </thead>
                @for ($i = 1;$i <= 5;$i++)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>画像画像</td>
                            <td>作品名作品名</td>
                            <td>閲覧日閲覧日</td>
                        </tr>
                    </tbody>
                @endfor
            </table>
            <nav aria-label="Page navigation example text-center">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">前へ</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">次へ</a></li>
                </ul>
            </nav>
        </div>

        <div class="collapse card" id="search">
            <h4 class="card-title text-center mb-4 mt-1">閲覧履歴</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">画像</th>
                        <th scope="col">作品名</th>
                        <th scope="col">閲覧日</th>
                    </tr>
                </thead>
                @for ($i = 1;$i <= 5;$i++)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>画像画像</td>
                            <td>作品名作品名</td>
                            <td>閲覧日閲覧日</td>
                        </tr>
                    </tbody>
                @endfor
            </table>
            <nav aria-label="Page navigation example text-center">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">前へ</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">次へ</a></li>
                </ul>
            </nav>
        </div>

        <div class="collapse card" id="myrecommend">
            <h4 class="card-title text-center mb-4 mt-1">閲覧履歴</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">画像</th>
                        <th scope="col">作品名</th>
                        <th scope="col">閲覧日</th>
                    </tr>
                </thead>
                @for ($i = 1;$i <= 5;$i++)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>画像画像</td>
                            <td>作品名作品名</td>
                            <td>閲覧日閲覧日</td>
                        </tr>
                    </tbody>
                @endfor
            </table>
            <nav aria-label="Page navigation example text-center">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">前へ</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">次へ</a></li>
                </ul>
            </nav>
        </div>

        <div class="collapse card" id="allrecommend">
            <h4 class="card-title text-center mb-4 mt-1">閲覧履歴</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">画像</th>
                        <th scope="col">作品名</th>
                        <th scope="col">閲覧日</th>
                    </tr>
                </thead>
                @for ($i = 1;$i <= 5;$i++)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $i }}</th>
                            <td>画像画像</td>
                            <td>作品名作品名</td>
                            <td>閲覧日閲覧日</td>
                        </tr>
                    </tbody>
                @endfor
            </table>
            <nav aria-label="Page navigation example text-center">
                <ul class="pagination">
                    <li class="page-item"><a class="page-link" href="#">前へ</a></li>
                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item"><a class="page-link" href="#">次へ</a></li>
                </ul>
            </nav>
        </div>
    </article>
</div>

        <div class="text-center">
            <a href="#" class="btn" onclick="window.open('','_self').close();" >閉じる</a>
        </div>

    </body>