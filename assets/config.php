<?php

/*
    サイト設定などはここで出来ます。
    何かあったら連絡してください。
*/

$url = empty($_SERVER["HTTPS"]) ? "http://" : "https://";
$url .= $_SERVER["HTTP_HOST"];

$conf = [
    "url" => $url,
    "keywords" => "第二種電気工事士,電気工事士,対策,筆記試験,独学"
];


// 全ページ共通ヘッダー
$html["common_head"] = <<<__EOM__
    <!-- アイコン -->
    <link rel="icon" href="{$conf["url"]}/assets/img/icons/favicon.ico">
    <link rel="apple-touch-icon" href="{$conf["url"]}/assets/img/icons/apple-touch-icon.png" sizes="180x180">
    <link rel="icon" type="image/png" href="{$conf["url"]}/assets/img/icons/android-touch-icon.png" sizes="192x192">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <meta http-equiv="Content-Type" content="text/html; charset=Shift_Jis">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css">
    <link rel="stylesheet" href="{$conf["url"]}/assets/css/style.css" type="text/css">
    <link rel="stylesheet" href="{$conf["url"]}/assets/css/header.css" type="text/css">
    <link rel="stylesheet" href="{$conf["url"]}/assets/css/footer.css" type="text/css">
    <link rel="stylesheet" href="{$conf["url"]}/assets/css/lightbox.css" type="text/css">
    <!-- その他 -->
    <meta name="keywords" content="{$conf["keywords"]}" />
__EOM__;

$html["common_foot"] = <<<__EOM__
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="{$conf["url"]}/assets/js/lightbox.js"></script>
    <script>
        lightbox.option({
            'wrapAround': true,
            'albumLabel': '全部で%2枚あって今%1枚目の画像 '
        })
        $(function(){
            $("#acMenu dt").on("click", function() {
                $(this).next().slideToggle();
                $(this).toggleClass('active');
                if($(this).hasClass('active')){
                    var text = $(this).data('text-clicked');
                } else {
                    var text = $(this).data('text-default');
                }
                $(this).html(text);
            });
        });
    </script>
__EOM__;

// 全ページ共通ヘッダーの最後に追記する場合
/*
$html["append_head"] = <<<__EOM__
__EOM__;
*/
