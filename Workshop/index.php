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
    <div class="row">
        <div class="col-lg-6 col-sm-12">
            <h2>タイムスケジュール</h2>
            <table class="table table-striped" style="text-align: center;">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Day1(10/12[Sun])</th>
                    <th scope="col">Day2(10/13[Mon])</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>10:00~11:00</td>
                    <td>10:00~11:00</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>12:00~13:00</td>
                    <td>13:00~14:00</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>14:00~15:00</td>
                    <td>-</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-lg-6 col-sm-12">
            <h2>受付状況</h2>
            <table class="table table-striped" style="text-align: center;">
                <thead class="thead-light">
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Day1(10/12[Sun])</th>
                    <th scope="col">Day2(10/13[Mon])</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>◯</td>
                    <td>◯</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>◯</td>
                    <td>◯</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>◯</td>
                    <td>-</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-12">
            <h1>発券はコチラから</h1>
            <button type="button" id="print_button" class="btn btn-primary">発券</button>
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
