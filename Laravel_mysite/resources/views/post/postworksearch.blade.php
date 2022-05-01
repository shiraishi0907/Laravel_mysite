
<div class="form-group">
    @if ($postdisplaydata['browsehistorytitle'])
        <button type="button" class="btn btn-primary btn-block searchclass" id="#workhistory">閲覧履歴から探す</button>
    @else
        <button type="button" class="btn btn-primary btn-block searchclass disabled" id="#workhistory" disabled>閲覧履歴から探す</button>
    @endif
</div> 
<div class="form-group">
    @if ($postdisplaydata['favoritetitle'])  
        <button type="button" class="btn btn-primary btn-block searchclass" id="#favorite">お気に入りから探す</button>
    @else
        <button type="button" class="btn btn-primary btn-block searchclass disabled" id="#favorite" disabled>お気に入りから探す</button>
    @endif
</div> 
<div class="form-group">
    <button type="button" class="btn btn-primary btn-block searchclass" id="#myrecommend">あなたのおすすめランキングから探す</button>
</div> 
<div class="form-group">
    <button type="button" class="btn btn-primary btn-block searchclass" id="#allrecommend">今週のおすすめランキングから探す</button>
</div> 

@if (!empty($postdisplaydata['browsehistorytitle']))
    <div class="worksearch card" id="workhistory">
        <div class="workhistorymodal">
            <h4 class="card-title text-center mb-4 mt-1">閲覧履歴から探す</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">作品名</th>
                        <th scope="col">閲覧日時</th>
                    </tr>
                </thead>
                @for ($i = 0;$i < count($postdisplaydata['browsehistorytitle']);$i++)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $i+1 }}</th>
                            <td>{{ $postdisplaydata['browsehistorytitle'][$i] }}</td>
                            <td>{{ $postdisplaydata['browsehistorytime'][$i] }}</td>
                        </tr>
                    </tbody>
                @endfor
            </table>
        </div>
    </div>
@endif

@if (!empty($postdisplaydata['favoritetitle']))  
    <div class="worksearch card" id="favorite">
        <div class="workhistorymodal">
            <h4 class="card-title text-center mb-4 mt-1">お気に入りから探す</h4>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">作品名</th>
                    </tr>
                </thead>
                @for ($i = 0;$i < count($postdisplaydata['favoritetitle']);$i++)
                    <tbody>
                        <tr>
                            <th scope="row">{{ $i+1 }}</th>
                            <td>{{ $postdisplaydata['favoritetitle'][$i] }}</td>
                        </tr>
                    </tbody>
                @endfor
            </table>
        </div>
    </div>
@endif

<div class="worksearch card" id="myrecommend">
    <div class="workhsearchmodal">
        <h4 class="card-title text-center mb-4 mt-1">あなたのおすすめランキングから探す</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">作品名</th>
                    <th scope="col">最新閲覧日</th>
                </tr>
            </thead>
            @for ($i = 1;$i <= 5;$i++)
                <tbody>
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>作品名作品名</td>
                        <td>閲覧日閲覧日</td>
                    </tr>
                </tbody>
            @endfor
        </table>
    </div>
</div>

<div class="worksearch card" id="allrecommend">
    <div class="workhsearchmodal">
        <h4 class="card-title text-center mb-4 mt-1">今週のおすすめランキングから探す</h4>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">作品名</th>
                    <th scope="col">最新閲覧日</th>
                </tr>
            </thead>
            @for ($i = 1;$i <= 5;$i++)
                <tbody>
                    <tr>
                        <th scope="row">{{ $i }}</th>
                        <td>作品名作品名</td>
                        <td>閲覧日閲覧日</td>
                    </tr>
                </tbody>
            @endfor
        </table>
    </div>        
</div>        

<script>
    $(function() {
        $('.worksearch').hide(); //初期化として、要素を隠す。(初期化)

        $('.searchclass').click(function(){
            //searchclassクラス(this)の中で、対応するidを引っ張って、それに対応するid以外のworksearch要素内のidを隠す
            $('.worksearch').not($($(this).attr('id'))).hide(); 
            //対応するidのworksearch要素内のidは表示 (クリックしたボタンに紐づくidを表示したいから)
            $($(this).attr('id')).show(); 
        });
    });
</script>