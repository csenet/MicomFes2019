<?php
/*ヘッダー*/
include("../include/header.php");
?>
<?php
header('Content-Type: text/html; charset=UTF-8');
$dsn = 'mysql:host=localhost;dbname=workshop;charset=utf8';
$user = 'root';
$password = 'Sparc3sparc';
$pdo = new PDO ($dsn, $user, $password);
if (isset($_GET["task"])) {
    $stmt = $pdo->query("DELETE FROM entry WHERE id = " . $_GET["id"]);
    ?>
    <div class="container-fluid">
        <p>
        <h2>WorkShop 予約確認・取消</h2></p>
        <p>
            取り消しが完了しました。
        </p>
        <p><a href="check.php">戻る</a></p>
    </div>
    </div>
    <?php
    exit();
}
if (isset($_POST["number"])) {
    try {
        $stmt = $pdo->query("SELECT * FROM entry");
        $index = 0;
        $searched = -1;
        $data = array();
        foreach ($stmt as $value) {
            if ($value[id] == $_POST["number"]) {
                $searched = $index;
                $data = $value;
                break;
            }
            $index++;
        }
    } catch (Exception $e) {
        echo 'Error Occurred: ', $e->getMessage(), "\n";
        exit();
    }
    if ($searched >= 0) {
        ?>
        <div class="container-fluid">
            <p>
            <h2>WorkShop 予約確認・取消</h2></p>
            <p>
                予約は以下のとおりです。
            </p>
            <div class="col-lg-6 col-md-12">
                <table class="table table-striped">
                    <tbody>
                    <tr>
                        <td>予約番号</td>
                        <td><?php echo $_POST["number"]; ?></td>
                    </tr>
                    <tr>
                        <td>Date</td>
                        <td><?php echo $data[date]; ?></td>
                    </tr>
                    <tr>
                        <td>Time</td>
                        <td><?php echo $data[time]; ?></td>
                    </tr>
                    <tr>
                        <td>Status</td>
                        <td><?php echo $data[status]; ?></td>
                    </tr>
                    <tr>
                        <td>Experience</td>
                        <td><?php echo $data[exp]; ?></td>
                    </tr>
                    <tr>
                        <td>Mail Adress</td>
                        <td><?php if ($data[mailAdress] != "") {
                                echo $data[mailAdress];
                            } else {
                                echo "NONE";
                            } ?></td>
                    </tr>
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary btn-block btn-lg btn-info col-lg-5 mx-auto"
                        onClick='window.open("check.php?id=<?php echo $_POST["number"]; ?>&task=cancel","_self");'>取消
                </button>
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
                    <h2>WorkShop 予約確認・取り消し</h2></p>
                    <p>ご指定の予約番号は存在しません。</p>
                    <a href="check.php">戻る</a>
                </div>
            </div>
        </div>
        <?php
    }
} else {
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <p>
                <h2>WorkShop 予約確認・取り消し</h2></p>
                <form action="check.php" method="post" class="form-inline">
                    <div class="form-group mx-sm-3 mb-2">
                        <label for="number" class="col-form-label-lg">予約番号：</label>
                        <input type="number" name="number" class="form-control form-control-lg"
                               placeholder="6桁の予約番号">
                    </div>
                    <div class="form-group mx-sm-3 mb-2">
                        <button type="submit" class="btn btn-primary btn-block btn-lg btn-info col-form-label mx-auto">
                            照会
                        </button>
                    </div>
                    <p><a href="check.php">戻る</a></p>
                </form>
            </div>
        </div>
    </div>
    <?php
}
?>
</body>

</html>
