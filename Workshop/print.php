<!doctype html>
<html lang="ja">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
            integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
            crossorigin="anonymous"></script>

    <script src="./js/jquery-barcode.js"></script>
    <style>
        .center {
            text-align: -webkit-center;
            text-align: -moz-center;
        }
    </style>
    <title>受付票プリント</title>

</head>
<body>
<div style="text-align: center;">
    <h3>
        マイコン制御部弟燕祭<br>
        ワークショップ参加票
    </h3>
    <h4 style="display:inline;">
        第<?php echo $_GET["times"] ?>回
        <?php echo $_GET["date"] ?>~
    </h4>
    <span style="font-size: small; ">
        <br>
        <?php echo $_GET["kind"] ?><br>
        <?php echo $_GET["skill"] ?><br>
        ※開始時刻の5分前までに1号館<br>
        4階の402教室へお越しください
    </span>
</div>
<div class="center">
    <div id="barcode"></div>
</div>
<br>
<script>
    //自動プリント
    $(window).on('load', function () {
        setTimeout(function () {
            window.print();
            window.close();
        }, 200);
    });
    //バーコード表示
    $(function () {
        $("#barcode").barcode("1234567890128", "ean13", {barWidth: 2, barHeight: 30});
    });
</script>
</body>

</html>
