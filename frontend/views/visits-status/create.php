<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\VisitsStatus $model */

$this->title = 'Create Visits Status';
$this->params['breadcrumbs'][] = ['label' => 'Visits Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="visits-status-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
