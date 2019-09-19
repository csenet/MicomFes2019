<?php
/*ヘッダー*/
include("../include/header.php");
?>
<div class="container">
    <h1>Micro::bitで遊ぼう！</h1>
    <button type="button" id="print_button" class="btn btn-primary">発券</button>
    <script>
        $('#print_button').on('click', function (e) {
            var url = './print.php?code=1010000000000&date=14:00&kind=中学生[一般]&times=3&skill=経験有り';
            window.open(url);
        })
    </script>
</div>
</body>

</html>
