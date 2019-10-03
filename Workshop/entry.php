<?php
/*ヘッダー*/
include("../include/header.php");
?>
<?php
if (isset($_POST["date"])) {
    header('Content-Type: text/html; charset=UTF-8');
    $dsn = 'mysql:host=localhost;dbname=workshop;charset=utf8';
    $user = 'root';
    $password = 'Sparc3sparc';
    $id = rand(100000, 999999);
    try {
        $pdo = new PDO ($dsn, $user, $password);
        $stmt = $pdo->prepare("INSERT INTO entry (
                                    id,date,time,exp,status,mailAdress
                                ) VALUES (
                                    :id,:date,:time,:exp,:status,:mailAdress
                                )");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':date', $_POST["date"], PDO::PARAM_STR);
        $stmt->bindParam(':time', $_POST["time"], PDO::PARAM_STR);
        $stmt->bindParam(':exp', $_POST["experience"], PDO::PARAM_STR);
        $stmt->bindParam(':status', $_POST["status"], PDO::PARAM_STR);
        $stmt->bindParam(':mailAdress', $_POST["email"], PDO::PARAM_STR);
        $stmt->execute();
        mb_language("Japanese");
        mb_internal_encoding("UTF-8");
        $to = $_POST["email"];
        $title = "文化祭ワークショップ予約確認";
        $content = "
        文化祭ワークショップへ予約有難うございます。\n
        予約番号:" . $id . "\n
        日付:" . $_POST["date"] . "\n
        時間:" . $_POST["time"] . "\n
        経験:" . $_POST["experience"] . "\n
        種別:" . $_POST["time"] . "\n
        10分前には会場に来てください。";
        $from = "noreplay";
        $from_mail = "noreply@fes-micom.ml";
        $from_name = "【マイコン制御部】";
        $header = '';
        $header .= "Content-Type: text/plain \r\n";
        $header .= "Return-Path: " . $from_mail . " \r\n";
        $header .= "From: " . $from . " \r\n";
        $header .= "Sender: " . $from . " \r\n";
        $header .= "Reply-To: " . $from_mail . " \r\n";
        $header .= "Organization: " . $from_name . " \r\n";
        $header .= "X-Sender: " . $from_mail . " \r\n";
        $header .= "X-Priority: 3 \r\n";
        if (mb_send_mail($to, $title, $content, $header)) {
        } else {
            echo "メールの送信に失敗しました";
        };
    } catch (Exception $e) {
        echo 'Error Occurred: ', $e->getMessage(), "\n";
        exit();
    }
    ?>
    <div class="container-fluid">
        <p>
        <h2>WorkShop 新規予約</h2></p>
        <p>
            予約が完了しました。<br>
            当日は予約番号を提示してください。<br>
            また，予約番号は変更・取り消し時に必要となるので必ずメモをしてください。<br>
            なお，迷惑メールになっている可能性が高いのでメールが届かない場合は確認してください。
        </p>
        <div class="col-lg-6 col-md-12">
            <table class="table table-striped">
                <tbody>
                <tr>
                    <td>予約番号</td>
                    <td><?php echo $id; ?></td>
                </tr>
                <tr>
                    <td>Date</td>
                    <td><?php echo $_POST["date"]; ?></td>
                </tr>
                <tr>
                    <td>Time</td>
                    <td><?php echo $_POST["time"]; ?></td>
                </tr>
                <tr>
                    <td>Status</td>
                    <td><?php echo $_POST["status"]; ?></td>
                </tr>
                <tr>
                    <td>Experience</td>
                    <td><?php echo $_POST["experience"]; ?></td>
                </tr>
                <tr>
                    <td>Mail Adress</td>
                    <td><?php if ($_POST["email"] != "") {
                            echo $_POST["email"];
                        } else {
                            echo "NONE";
                        } ?></td>
                </tr>
                </tbody>
            </table>
            <p><a href="check.php">戻る</a></p>
        </div>
    </div>
    <?php
} else {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p>
                <h2>WorkShop 新規予約</h2></p>
                <form action="entry.php" method="post">
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="date" class="col-form-label">Date:</label>
                            <select id="date" name="date" class="form-control form-control-lg">
                                <option>10/12[Sun]</option>
                                <option>10/13[Mon]</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="time" class="col-form-label">Time:</label>
                            <select id="time" name="time" class="form-control  form-control-lg">
                                <option>[1]10:00~11:00</option>
                                <option class="day1">[2]12:00~13:00</option>
                                <option class="day2">[2]13:00~14:00</option>
                                <option class="day1">[3]14:00~15:00</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="status" class="col-form-label">Status:</label>
                            <select id="status" name="status" class="form-control form-control-lg">
                                <option>小学生</option>
                                <option>中学1年生</option>
                                <option>中学2年生</option>
                                <option>中学3年生</option>
                                <option>高校(高専)1年生</option>
                                <option>高校(高専)2年生</option>
                                <option>高校(高専)3年生</option>
                                <option>高専4,5年生</option>
                                <option>大学生</option>
                                <option>学生(その他)</option>
                                <option>社会人</option>
                                <option>内部生</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="experience" class="col-form-label">EXPERIENCE:</label>
                            <select id="experience" name="experience" class="form-control form-control-lg">
                                <option>プログラミングの経験あり</option>
                                <option>電子工作の経験あり</option>
                                <option>経験無し</option>
                                <option>完全に理解している</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 col-sm-12">
                            <label for="email" class="col-form-label">MailAdress:</label>
                            <input type="email" name="email" class="form-control form-control-lg"
                                   placeholder="you@example.com">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block btn-lg btn-info col-lg-5 mx-auto">予約
                    </button>
                </form>
                <div id="PERFECT" style="display: none; padding-bottom: 30px; text-align: center;">
                    <br>
                    <img src="/images/perfect.png">
                </div>
                <p><a href="check.php">戻る</a></p>
            </div>
            <script>
                $(function () {
                    $("#date").change(function () {
                        switch ($("#date").val()) {
                            case "10/12[Sun]":
                                $('.day2').hide();
                                $('.day1').show();
                                break;
                            case "10/13[Mon]":
                                $('.day1').hide();
                                $('.day2').show();
                                break;
                        }
                    });
                    $("#experience").change(function () {
                        if ($("#experience").val() == "PERFECT") {
                            $("#PERFECT").fadeIn();
                        } else {
                            $("#PERFECT").fadeOut();
                        }
                    });
                });
            </script>
        </div>
    </div>
    <?php
}
?>
</body>

</html>
