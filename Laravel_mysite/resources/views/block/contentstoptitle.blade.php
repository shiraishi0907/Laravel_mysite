<div class="contentstopcontainer">
    <article class="card-body">
        <h2 class="card-title text-center mb-4 mt-1">
            <div class="contentstoptitle" id="contentstoptitle">{{ $tabletitle }}</div>
        </h2>
        @if(!empty($buttonname))
            <div class="d-flex justify-content-around">
                <span>{{ $rankingtitleleft }}</span>
                <span>{{ $rankingtitleright }}</span>
                <button type="button" class="btn btn-primary" id="rankingbutton">{{ $buttonname }}</button>
            </div>
        @endif
        <br>