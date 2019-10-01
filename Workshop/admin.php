<?php
/*ヘッダー*/
include("../include/header.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <p>
            <h1>受付状況</h1></p>
            <table class="table table-striped" style="text-align: center;">
                <thead class="thead-light">
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">time</th>
                    <th scope="col">exp</th>
                    <th scope="col">status</th>
                    <th scope="col">mailAdress</th>
                </tr>
                </thead>
                <tbody>
                <?php
                header('Content-Type: text/html; charset=UTF-8');
                $dsn = 'mysql:host=localhost;dbname=workshop;charset=utf8';
                $user = 'root';
                $password = '';
                try {
                    $pdo = new PDO ($dsn, $user);
                    $stmt = $pdo->query("SELECT * FROM entry");
                    /*
                    $stmt = $pdo->prepare("INSERT INTO entry (
                                                id,time,exp,status,mailAdress
                                            ) VALUES (
                                                :id,:time,:exp,:status,:mailAdress
                                            )");
                    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
                    $stmt->bindParam(':time', $time, PDO::PARAM_INT);
                    $stmt->bindParam(':exp', $exp, PDO::PARAM_STR);
                    $stmt->bindParam(':status', $status, PDO::PARAM_STR);
                    $stmt->bindParam(':mailAdress', $mailAdress, PDO::PARAM_STR);

                    $stmt->execute();
                    */
                    foreach ($stmt as $value) {
                        echo "<tr>";
                        echo '<th scope="col">' . $value[id] . '</th>';
                        echo "<td>$value[time]</td>";
                        echo "<td>$value[exp]</td>";
                        echo "<td>$value[status]</td>";
                        echo "<td>$value[mailAdress]</td>";
                        echo "</tr>";
                    }

                } catch (Exception $e) {
                    echo 'Error Occurred: ', $e->getMessage(), "\n";
                    exit();
                }
                ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>

</html>
