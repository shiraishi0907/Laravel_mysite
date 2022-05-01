<?php
    $title = 'ジャンル投票';
?>

@include('include.header')

    @include('block.title')

        <form action="/mypage" method="POST">
            <h4>あなたの思うこの作品のカテゴリーを選んで下さい</h4>
            <div class="row">
                @for ($i = 1;$i <= count($category[1]);$i++)
                    <div class="col">
                        @foreach ($category[1][$i] as $cate)
                            <div class="genrepost-word">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="{{ $cate }}" name="genre[]">
                                    <label class="form-check-label" for="{{ $cate }}">{{ $cate }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>

            <h4>あなたの思うこの作品のイメージを選んで下さい</h4>
            <div class="row">
                @for ($i = 1;$i <= count($category[2]);$i++)
                    <div class="col">
                        @foreach ($category[2][$i] as $cate)
                            <div class="genrepost-word">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="{{ $cate }}" name="genre[]">
                                    <label class="form-check-label" for="{{ $cate }}">{{ $cate }}</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endfor
            </div>

            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">投票</button>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/mypage" role="button">戻る</a>
                </div>
            </div>
            </div>
        </form>

    @include('block.endtitle')

@include('include.footer')