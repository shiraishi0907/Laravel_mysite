
<?php
    $title = 'レビュー投稿確認';
?>

@include('include.header')

    @include('block.title')

        <form action="/post/complete" method="POST">
            @csrf
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-muted">ニックネーム</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $name }}</p>
                            <input type="hidden" name="name" value="{{ $name }}">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-muted">作品名</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $workname }}</p>
                            <input type="hidden" name="workname" value="{{ $workname }}">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-muted">評価</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $poststar }}</p>
                            <input type="hidden" name="poststar" value="{{ $poststar }}">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="row">
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <strong class="text-muted">レビュー内容</strong>
                        </div>
                    </div>
                </div> 
                <div class="col">
                    <div class="form-group">
                        <div class="input-group">
                            <p class="text-center">{{ $postbody }}</p>
                            <input type="hidden" name="postbody" value="{{ $postbody }}">
                        </div>
                    </div>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">送信</button>
                </div> 
            </div> 
            <div class="form-group">
                <div class="text-center">
                    <a class="btn btn-primary" href="/post" role="button">戻る</a>
                </div>
            </div>
        </form>
    
    @include('block.endtitle')

@include('include.footer')



