<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Visits $model */

$this->params['breadcrumbs'][] = ['label' => 'Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visits-update">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>