<?php

/* @var $this yii\web\View */

$this->title = 'MISS思念体后台管理';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Wellcome!</h1>

        <p class="lead">欢迎使用MISS思念体后台管理系统</p>

        <p></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4" style="float: left; width: 50%;">
                <h4>待审核认证信息</h4>
				
                <p></p>

                <p><a class="btn btn-default" href="/approve/avatar">头像认证：<?=$approve_avatar?></a></p>
                <p><a class="btn btn-default" href="/approve/car">汽车认证：<?=$approve_car?></a></p>
                <p><a class="btn btn-default" href="/approve/unmakeup">素颜认证：<?=$approve_unmakeup?></a></p>
                <p><a class="btn btn-default" href="/approve/video">视频认证：<?=$approve_video?></a></p>
                <p><a class="btn btn-default" href="/approve/id">身份认证：<?=$approve_id?></a></p>
                <p><a class="btn btn-default" href="/approve/part">身材认证：<?=$approve_part?></a></p>
            </div>
            <div class="col-lg-4" style="float: left; width: 50%;">
                <h4>待审核宣言信息</h4>

                <p></p>

                <p><a class="btn btn-default" href="/approve/photo">宣言审核：<?=$approve_photo?></a></p>
                <p><a class="btn btn-default" href="/approve/reportphoto">举报宣言：<?=$approve_reportphoto?></a></p>
                <p><a class="btn btn-default" href="/approve/reportcomment">举报评论：<?=$approve_reportcomment?></a></p>
                
                <p style="height: 30px;"></p>
                <h4>待审核照片信息</h4>

                <p></p>

                <p><a class="btn btn-default" href="/approve/open">公开照片：<?=$approve_open?></a></p>
                <p><a class="btn btn-default" href="/approve/private">私密照片：<?=$approve_private?></a></p>
            </div>
        </div>

    </div>
</div>
