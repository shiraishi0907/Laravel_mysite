$(function() {
    var contentstoptitle = document.getElementById("contentstoptitle");
    if (contentstoptitle.innerHTML == 'あなたのおすすめランキング') {
        $('#alluser').hide();
        $('#myuser').show();
    } else {
        $('#alluser').show();
        $('#myuser').hide();
    }

    $('#rankingbutton').click(function() {
        var contentstoptitle = document.getElementById("contentstoptitle");
        var rankingbutton = document.getElementById("rankingbutton");
        if (contentstoptitle.innerHTML == 'あなたのおすすめランキング') {
            contentstoptitle.textContent = '全ユーザーのおすすめランキング';
            rankingbutton.textContent = 'あなたのランキングへ';
            $('#alluser').show();
            $('#myuser').hide();
        } else {
            contentstoptitle.textContent = 'あなたのおすすめランキング';
            rankingbutton.textContent = '全ユーザーのランキングへ';
            $('#alluser').hide();
            $('#myuser').show();
        }
    })
})