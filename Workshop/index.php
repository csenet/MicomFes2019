<?php
/*ヘッダー*/
include("../include/header.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <img src="/images/workshop.PNG" style="width: 100%;">
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
            <h2>対象年齢</h2>
            <p>小学生以上</p>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <?php include('status.php'); ?>
        </div>
        <div class="col-lg-6 col-sm-12">
            <h2>参加予約</h2>
            <p>
                ワークショップへの参加は事前予約が必要です。<br>
                事前予約は以下より可能です。
            </p>
            <p>
                <button type="button"
                        class="btn btn-primary
                         btn-block
                         btn-lg
                         btn-success"
                        onclick='window.open("entry.php","_self");'>
                    新規予約
                </button>
                <button type="button"
                        id="print_button"
                        class="btn btn-primary
                        btn-block
                        btn-lg
                        btn-dark"
                        onclick='window.open("check.php","_self");'>
                    確認・取消
                </button>
            </p>
            <h2>問い合わせ</h2>
            <p>
                ワークショップの内容又は予約に関する問い合わせに関しては，以下の問い合わせフォーム又は直接部員までお願いします。
            </p>
            <button type="button"
                    class="btn btn-primary
                        btn-block
                        btn-lg
                        btn-info"
                    onclick='window.open("//forms.gle/Nx4cSbcMvuCrZLvF7");'>
                問い合わせフォーム
            </button>
            <p>
                また，当日の変更・取消については直接マイコン制御部の受付までお越しください。
            </p>
            <a href="check.php">戻る</a>
        </div>
    </div>
</div>
</body>

</html>
