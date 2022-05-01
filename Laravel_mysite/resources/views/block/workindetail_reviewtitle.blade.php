<div class="workindetail-reviewcontainer">
    <article class="card-body">
        @if(!empty($rankingtitle))
            <div class="d-flex justify-content-around">
                <span>{{ $rankingtitleleft }}</span>
                <span>{{ $rankingtitleright }}</span>
                <form name="postbutton" action="/post" method="GET">
                    <a class="btn btn-primary" href="/post" role="button" onClick='document.postbutton.submit();return false;'>{{ $rankingtitle }}</a>
                    <input type="hidden" name="worktitle" value="{{ $workdata['title'] }}">
                </form>
            </div>
        @endif
        <br>