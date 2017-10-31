<?php
use backend\components\widgets\Menu;
use mdm\admin\components\MenuHelper;
use yii\helpers\Url;

$callback = function($menu){
    eval($menu['data']);
    $items = [
        'label' => $menu['name'],
        'url' => [$menu['route']] ? : null,
    ];

    $items['icon'] = isset($icon) ? '<i class="'.$icon.'"></i>' : '<i class="fa fa-angle-double-right"></i>';

    if($menu['children']) {
        $items['options'] = ['class'=>'treeview'];
        $items['items'] = $menu['children'];
    }
    return $items;
};

$items = MenuHelper::getAssignedMenu(Yii::$app->user->getId(), null, $callback);

if(isset($this->params['breadcrumbs'][0]['url'])) {
    $route = trim(Url::toRoute($this->params['breadcrumbs'][0]['url']), '/');
}


?>
<aside class="main-sidebar">

    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel" style="height: 55px;">
            <div class="pull-left image">
                <!-- <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="User Image"/> -->
            </div>
            <div class="pull-left info" style="left: 0px;">
                <p><?= Yii::$app->user->identity->username ?>  <a href="/site/logout">退出</a></p>

                <i class="fa fa-circle text-success">管理员</i>
            </div>
        </div>

        <!-- search form -->
        
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <?=
        Menu::widget([
            'options'=>['class'=>'sidebar-menu'],
            'labelTemplate' => '<a href="#">{icon}{label}{right-icon}{badge}</a>',
            'linkTemplate' => '<a href="{url}">{icon}{label}{right-icon}{badge}</a>',
            'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
            'activateParents'=>true,
            'route' => isset($route) ? $route : null,
            'items' => $items,
        ]);
        ?>

    </section>

</aside>
