<?php
/*ヘッダー*/
include("./include/header.php");
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12" style="background: linear-gradient(darkorange,orange);">
            <?php
            /*スライダ*/
            include("./include/slide.php");
            ?>
        </div>
    </div>
    <div class="row" style="background: linear-gradient(skyblue,deepskyblue); display: none;">
        <div class="col-12" style="margin: 10px auto 10px">
            <!--メインコンテンツ-->
            <h1>Welcome to MCCC</h1>
            <p>マイコン制御部文化祭2019の特設サイトへようこそ</p>
        </div>
    </div>
    <div class="row" style="background: lightskyblue">
        <div class="col-12">
            <div class="card-deck" style="margin: 30px auto 30px;">
                <?php
                /*ニュース*/
                include("./include/news.php");
                ?>
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Tweets</h4>
                        <div class="card-text">
                            <a class="twitter-timeline" data-height="400" data-width="500"
                               data-chrome="noheader nofooter"
                               href="https://twitter.com/toufu_micom?ref_src=twsrc%5Etfw">Tweets
                                by toufu_micom</a>
                            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row" style="background: darkgray">
        <div class="col-12 copyright">
            Copyright© 2019
            Tokyo Tech High School of Science and Technology -
            MicroControllerControlClub. All Rights Reserved.
        </div>
    </div>
</div>
</body>

</html>
