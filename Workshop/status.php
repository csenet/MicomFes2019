<h2>受付状況</h2>
<table class="table table-striped" style="text-align: center;">
    <thead class="thead-light">
    <tr>
        <th scope="col">#</th>
        <th scope="col">10/12[Sun]</th>
        <th scope="col">10/13[Mon]</th>
    </tr>
    </thead>
    <tbody>
    <?php
    header('Content-Type: text/html; charset=UTF-8');
    $dsn = 'mysql:host=localhost;dbname=workshop;charset=utf8';
    $user = 'root';
    $password = '';
    $timeData = [
        ["10:00~11:00", "10:00~11:00"],
        ["12:00~13:00", "13:00~14:00"],
        ["14:00~15:00", ""]
    ];
    try {
        /*テストデータ*/
        $id = 10;
        $time = 11;
        $exp = "PRO";
        $status = "INDOOR";
        $mailAdress = "kouichi.hirachi@gmail.com";

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

        $status = [
            [0, 0],
            [0, 0],
            [0, 0]
        ];
        foreach ($stmt as $value) {
            $num = $value[time];
            $status[$num % 10 - 1][floor($num / 10) - 1]++;
        }
        $index = 1;
        foreach ($status as $value) {
            echo "<tr>";
            echo '<th scope="col" class="align-middle">' . $index . '</th>';
            $marks = ["◎", "◎"];
            $count = 0;
            foreach ($value as $temp) {
                if ($temp > 3) {
                    $marks[$count] = "◯";
                }
                if ($temp > 8) {
                    $marks[$count] = "△";
                }
                if ($temp >= 10) {
                    $marks[$count] = "✕";
                }
                $count++;
            }
            echo "<td class=\"align-middle\">" . $timeData[$index - 1][0] . "<h3>$marks[0]</h3>($value[0]/10)</td>";
            if ($index != 3) {
                echo "<td class=\"align-middle\">" . $timeData[$index - 1][1] . "<h3>$marks[1]</h3>($value[1]/10)</td>";
            } else {
                echo "<td class=\"align-middle\">ー</td>";
            }
            echo "</tr>";
            $index++;
        }
    } catch (Exception $e) {
        echo 'Error Occurred: ', $e->getMessage(), "\n";
        exit();
    }
    ?>
    </tbody>
</table>
