<?php

use frontend\controllers\GeneralController;
use yii\helpers\Html;
use yii\helpers\Url;
 
$general = new GeneralController(); 
$this->title = 'قائمة مستخدمي النظام';
$loggedInUserRole = $general->actiongetRole(Yii::$app->user->getId()); 
 ?>

<div class="container mt-4 user-data-index">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header text-white d-flex justify-content-between align-items-center"
             style="background-color: #3c8dbc;">
            <h5 class="mb-0"><i class="bi bi-people-fill me-2"></i> <?= Html::encode($this->title) ?></h5>
            <?php if ($loggedInUserRole === 'ROLE_ADMIN'): ?>



                    <?= Html::button(' <i class="bi bi-plus-circle me-1"></i> إضافة مستخدم جديد', [
            'value' => Url::to(['site/signup']),
            'title' => 'إضافة مستخدم جديد',
            'class' => 'btn btn-success showModalButton',
        ]) ?>



            <?php endif; ?>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table id="example23" class="table table-hover table-striped table-bordered align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th><i class="bi bi-person-vcard-fill me-1"></i> الاسم الكامل</th>
                            <th><i class="bi bi-person-badge me-1"></i> اسم المستخدم</th>
                            <th><i class="bi bi-phone me-1"></i> رقم الجوال</th>
                            <th><i class="bi bi-shield-lock-fill me-1"></i> الصلاحيات</th>
                            <th><i class="bi bi-toggle-on me-1"></i> الحالة</th>
                            <?php if ($loggedInUserRole === 'ROLE_ADMIN'): ?>
                                <th><i class="bi bi-gear-fill me-1"></i> الإجراءات</th>
                            <?php endif; ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $count = 1; ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?= $count ?></td>
                                <td><?= Html::encode($row->full_name) ?></td>
                                <td><?= Html::encode($row->username) ?></td>
                                <td><?= Html::encode($row->mobile) ?></td>
                                <td>
                                    <?php
                                        $badgeClass = match ($row->role) {
                                            'ROLE_ADMIN' => 'bg-success',
                                            'ROLE_USER' => 'bg-primary',
                                            default => 'bg-secondary',
                                        };
                                    ?>
                                    <span class="badge <?= $badgeClass ?>"><?= Html::encode($row->role) ?></span>
                                </td>
                                <td>
                                    <?php if ($row->status == '10'): ?>
                                        <span class="badge bg-success">نشط</span>
                                    <?php else: ?>
                                        <span class="badge bg-danger">معطّل </span>
                                    <?php endif; ?>
                                </td>
                                <?php if ($loggedInUserRole === 'ROLE_ADMIN'): ?>
                                    <td>
                                        <?= Html::button('<i class="bi bi-pencil-square"></i>', [
    'class' => 'btn btn-sm btn-outline-primary me-1 showModalButton',
    'value' => Url::to(['user/update', 'id' => $row->id]),
    'data-title' => 'تعديل المستخدم'
]) ?>

<?= Html::button('<i class="bi bi-shield-lock"></i>', [
    'class' => 'btn btn-sm btn-outline-warning me-1 showModalButton',
    'value' => Url::to(['/site/change-password', 'id' => $row->id]),
    'data-title' => 'إعادة تعيين كلمة المرور'
]) ?>

                                        <?= Html::a('<i class="bi bi-person-x"></i>', ['user/deactivate', 'id' => $row->id], [
                                            'class' => 'btn btn-sm btn-outline-danger',
                                            'title' => 'تعطيل المستخدم',
                                            'data' => [
                                                'confirm' => 'هل أنت متأكد من تعديل حالة هذا المستخدم؟',
                                                'method' => 'post',
                                            ],
                                        ]) ?>
                                    </td>
                                <?php endif; ?>
                            </tr>
                            <?php $count++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
