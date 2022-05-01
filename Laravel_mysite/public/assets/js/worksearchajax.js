    function searchAjax() {

            //五十音検索(チェックが押されたもの)
            var kana = [];
            let check = document.getElementsByName("gojuon");
            for (let i = 0; i < check.length; i++) {
                if (check[i].checked) {
                    kana.push(check[i].value);
                }
            }

            //映画ジャンル
            const work = $("#work").val();
            //アーティスト
            const artist = $("#artist").val();
            //キーワード
            const keyword = $("#keyword").val();
            $.ajax({

                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                //DBから検索結果を取得
                url: "/work_search/gojuonsearch",
                type: "post",
                data: {
                    word: kana,
                    work: work,
                    artist: artist,
                    keyword: keyword,
                },
                dataType: "json",

            }).done( function(response) {

                if (Object.keys(response["data"]).length != 0) {
                    var createTable = ``;
                    createTable = `<table class="table-class" id="table-id"><tr class="tr-class"><th class="sharp-class">#</th><th class="title-class">タイトル</th><th class="category-class">カテゴリー</th><th class="explaining-class">説明</th></tr>`;
                    //必要パラメータ (検索結果数、#、作品名、カテゴリー、説明)
                    //tr要素作成
                    for (let i = 0;i < Object.keys(response["data"]).length;i++) {
                        createTable += `<tr class="tr-class"><td class="sharp-` + (i+1) + `">` + (i+1) + `</td><td class="title-` + (i+1) + `">${response["data"][i]["title"]}</td><td class="category-` + (i+1) + `">${response["data"][i]["title"]}</td><td class="explaining-` + (i+1) + `">${response["data"][i]["explaining"]}</td></tr>`;
                    }
                    createTable += `</table>`;
                    $("#collapsesearchbuttonid").html(createTable);
                } else {
                    $("#collapsesearchbuttonid").html('<div id="not-search">検索結果がありません。</div>');
                }

            }).fail( function() {
                $("#collapsesearchbuttonid").html('<div id="fail">通信が失敗しました。もう一度検索してください。</div>');
            })

    }