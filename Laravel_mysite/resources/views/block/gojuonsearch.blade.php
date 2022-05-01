<?php 
    $gojuon_agyo = ['わ','ら','や','ま','は','な','た','さ','か','あ'];
    $gojuon_igyo = ['　','り','　','み','ひ','に','ち','し','き','い'];
    $gojuon_ugyo = ['　','る','ゆ','む','ふ','ぬ','つ','す','く','う'];
    $gojuon_egyo = ['　','れ','　','め','へ','ね','て','せ','け','え'];
    $gojuon_ogyo = ['　','ろ','よ','も','ほ','の','と','そ','こ','お'];
?>

<div class="card">
    <div class="card-body">
        <div class="form-group">
            <div class="text-center" name="gojuondivclass">
                @foreach ($gojuon_agyo as $agyo)
                    <input type="checkbox" name="gojuon" class="gojuonclass" id="{{ $agyo }}" value="{{ $agyo }}">
                    <label for="{{ $agyo }}">
                        <div class="hiragana-{{ $agyo }}">{{ $agyo }}</div>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="text-center" name="gojuondivclass">
                @foreach ($gojuon_igyo as $igyo)
                    <input type="checkbox" name="gojuon" class="gojuonclass" id="{{ $igyo }}" value="{{ $igyo }}">
                    <label for="{{ $igyo }}">
                        <div class="hiragana-{{ $igyo }}">{{ $igyo }}</div>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="text-center" name="gojuondivclass">
                @foreach ($gojuon_ugyo as $ugyo)
                    <input type="checkbox" name="gojuon" class="gojuonclass" id="{{ $ugyo }}" value="{{ $ugyo }}">
                    <label for="{{ $ugyo }}">
                        <div class="hiragana-{{ $ugyo }}">{{ $ugyo }}</div>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="text-center" name="gojuondivclass">
                @foreach ($gojuon_egyo as $egyo)
                    <input type="checkbox" name="gojuon" class="gojuonclass" id="{{ $egyo }}" value="{{ $egyo }}">
                    <label for="{{ $egyo }}">
                        <div class="hiragana-{{ $egyo }}">{{ $egyo }}</div>
                    </label>
                @endforeach
            </div>
        </div>
        <div class="form-group">
            <div class="text-center" name="gojuondivclass">
                @foreach ($gojuon_ogyo as $ogyo)
                    <input type="checkbox" name="gojuon" class="gojuonclass" id="{{ $ogyo }}" value="{{ $ogyo }}">
                    <label for="{{ $ogyo }}">
                        <div class="hiragana-{{ $ogyo }}">{{ $ogyo }}</div>
                    </label>
                @endforeach
            </div>
        </div>
    </div>
</div>
<br>