<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var frontend\models\Visits $model */

\yii\web\YiiAsset::register($this);
?>

<div class="container mt-4">
    <div class="card shadow border-0 rounded">
        <div class="card-header bg-primary text-white text-center py-3">
            <h4 class="mb-0">
                <i class="bi bi-journal-text me-2"></i>
                <?= Html::encode($model->title) ?>
            </h4>
        </div>

        <div class="card-body px-4 py-3">

            <div class="row mb-4">
                <div class="col-md-6 mb-3">
                    <i class="bi bi-calendar-event-fill text-primary me-2"></i>
                    <strong>تاريخ الزيارة:</strong>
                    <div class="border rounded bg-light p-2"><?= Yii::$app->formatter->asDate($model->visit_date) ?>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <i class="bi bi-clock-fill text-primary me-2"></i>
                    <strong>وقت الزيارة:</strong>
                    <div class="border rounded bg-light p-2"><?= Yii::$app->formatter->asTime($model->visit_time) ?>
                    </div>
                </div>
            </div>

            <div class="mb-4">
                <i class="bi bi-clipboard-check-fill text-success me-2"></i>
                <strong>سبب الزيارة:</strong>
                <div class="border rounded bg-light p-3"><?= nl2br(Html::encode($model->purpose)) ?></div>
            </div>

            <div class="mb-4">
                <i class="bi bi-chat-text-fill text-info me-2"></i>
                <strong>ملاحظات:</strong>
                <div class="border rounded bg-light p-3"><?= nl2br(Html::encode($model->notes)) ?></div>
            </div>

            <div class="mb-4">
                <i class="bi bi-calendar-check text-dark me-2"></i>
                <strong>تاريخ الإنشاء:</strong>
                <div class="border rounded bg-light p-2"><?= Yii::$app->formatter->asDatetime($model->created_at) ?>
                </div>
            </div>

            <div class="mb-2">
                <i class="bi bi-paperclip text-secondary me-2"></i>
                <strong>الملف المرفق:</strong><br>
                <?php if ($model->attachment_path && file_exists(Yii::getAlias('@webroot/' . $model->attachment_path))): ?>
                    <?= Html::a(
                        '<i class="bi bi-download"></i> تحميل الملف',
                        Yii::getAlias('@web/' . $model->attachment_path),
                        ['class' => 'btn btn-outline-primary mt-2', 'target' => '_blank']
                    ) ?>
                <?php else: ?>
                    <span class="badge bg-secondary mt-2">لا يوجد ملف مرفق</span>
                <?php endif; ?>
            </div>

        </div>
    </div>
</div>