<?php
/*ヘッダー*/
include("../include/header.php");
?>
<div class="container">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <img src="/images/seminar_2019.png" style="width: 100%;">
        </div>
        <div class="col-lg-6 col-sm-12">
            <h1>Workshop</h1>
            <h2>概要</h2>
            <p>
                micro:bitというマイコンを使って簡単な電子工作をします！<br>
                初心者でも全然大丈夫です！
            </p>
            <h2>定員</h2>
            <p>各回10名まで[先着順]</p>
            <h2>参加費</h2>
            <p>無料</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <?php include('status.php'); ?>
        </div>
        <div class="col-lg-6 col-sm-12">
            <h2>新規予約</h2>
            <p>
                <button type="button"
                        id="print_button"
                        class="btn btn-primary">発券
                </button>
            </p>
            <script>
                $('#print_button').on('click', function (e) {
                    var url = './print.php?code=1010000000000&date=14:00&kind=中学生[一般]&times=3&skill=経験有り';
                    window.open(url);
                })
            </script>
        </div>
    </div>
</div>
</body>

</html>
