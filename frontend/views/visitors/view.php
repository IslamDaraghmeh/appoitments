<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var frontend\models\Visitors $model */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="visitors-view">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'full_name',
            'identity_number',
            'phone',
            'email:email',
            'purpose:ntext',
            'visit_date',
            'visit_time',
            'status',
            'notes:ntext',
            'created_at',
            'updated_at',
        ],
    ]) ?>

</div>