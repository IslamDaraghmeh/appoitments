<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Visitors $model */

$this->title = 'Update Visitors: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Visitors', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="visitors-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
<?php
$script = <<<JS
$('form#{$model->formName()}').on('beforeSubmit', function(e){
    var form = $(this);
    $.post(form.attr('action'), form.serialize())
        .done(function(response){
            if(response === 'success'){
                $('#modal').modal('hide');
                $.pjax.reload({container:'#visitor-results'});
            } else {
                $('#modalContent').html(response);
            }
        });
    return false;
});
JS;
$this->registerJs($script);
?>