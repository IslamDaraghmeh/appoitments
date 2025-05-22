<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\VisitsStatus $model */

$this->title = 'Update Visits Status: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Visits Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visits-status-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
