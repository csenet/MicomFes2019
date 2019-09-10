<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
  crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"
  integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut"
  crossorigin="anonymous"></script>

  <script src="./js/jquery-barcode.min.js"></script>
  <script src="./js/jquery-barcode.js"></script>

  <title>受付票プリント</title>
  <script>
    //自動プリント
    /*
    $(window).on('load', function() {
      setTimeout(function() {
        window.print();
        window.close();
      }, 200);
    })
    */
    //バーコード表示
    $(function(){
       $("#barcode").barcode("1000000000000", "ean13", {barWidth:2,barHeight:30});
    });
  </script>
</head>
<body>
  <center>
    <h3>
      マイコン制御部弟燕祭<br>
      ワークショップ参加票
    </h3>
  <h4 style="display:inline;">
    第<?php echo $_GET["times"]?>回
    <?php echo $_GET["date"]?>~
  </h4>
  <font size=2>
    <br>
    <?php echo $_GET["kind"]?><br>
    <?php echo $_GET["skill"]?><br>
  </center>
    ※開始時刻の5分前までに1号館4階の402教室へお越しください
  </font>
  <br>
  <br>
  <center>
    <div id="barcode"></div>
  </center>
</body>

</html>
