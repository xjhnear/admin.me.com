<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 */

$this->title = Yii::t('rbac-admin', 'Create Role');
$this->params['breadcrumbs'][] = ['label' => Yii::t('rbac-admin', 'Roles'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="auth-item-create box">

	<div class="box-body">
        <?php echo $this->render('_form', [
            'model' => $model,
        ]); ?>
    </div>

</div>
