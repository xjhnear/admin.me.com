<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">MISS</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
		<a href="/admin/user/password" class="content-header" style="float: right;color: #fff;font-weight: bold;">修改密码</a>

    </nav>
    <script type='text/javascript' src='/js/jquery.js'></script>
      <link href="/css/bootstrap.min.css" rel="stylesheet">
      <link href="/css/font-awesome.min.css" rel="stylesheet">
      <link rel="stylesheet" type="text/css" media="all" href="/css/daterangepicker-bs3.css" />
      <script type="text/javascript" src="/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/js/moment.js"></script>
      <script type="text/javascript" src="/js/daterangepicker.js"></script>
      <script type="text/javascript" src="/js/adddate.js"></script>
</header>
