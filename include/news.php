<div class="card">
    <!--<img class="card-img-top" src="/images/download.png" alt="Card image cap" style="width:80%;">-->
    <div class="card-body">
        <h4 class="card-title">News</h4>
        <hr>
        <p class="card-text">
            <a>サイト開設</a><br>
            <small class="text-muted">Updated: 2019/09/19</small>
        <hr>
        </p>
        <p class="card-text">
            <small class="text-muted">
                Last Update:
                <?php
                $path = dirname(__FILE__);
                date_default_timezone_set('Asia/Tokyo');
                echo date("Y/m/d H:i", filemtime($path));
                ?>
            </small>
        </p>
    </div>
</div>