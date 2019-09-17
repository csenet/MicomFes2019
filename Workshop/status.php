<?php
/*データベス接続情報*/
$dsn = 'mysql:dbname=workshop; host=localhost;port=8889; charset=utf8';
$user = 'workshop';
$password = 'fUpVBMqQadomUbOW';

try {
    $dbh = new PDO ($dsn, $user, $password);
    print "接続成功";

    $sql = 'SELECT * FROM entry';
    $statement = $dbh->query($sql);

    $row_count = $statement->rowCount();

    while ($row = $statement->fetch()) {
        $rows[] = $row;
    }

    $dbh = null;
} catch (PDOException $e) {
    print "接続エラー:{$e->getMessage()}";
}
$sql = null;
?>
<!DOCTYPE html>
<html>
<head>
    <title>nameテーブル表示</title>
    <meta charset="utf-8">
</head>
<body>
<h1>テーブル表示</h1>

レコード件数：<?php echo $row_count; ?>

<table border='1'>
    <tr>
        <td>id</td>
        <td>name</td>
        <td>time</td>
        <td>category</td>
    </tr>

    <?php
    foreach ($rows as $row) {
        ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['day']; ?></td>
            <td><?php echo $row['time']; ?></td>
            <td><?php echo $row['category']; ?></td>
        </tr>
        <?php
    }
    ?>

</table>

</body>
</html>