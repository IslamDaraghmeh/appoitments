<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\LinkPager;

foreach ($dataProvider->getModels() as $i => $model): ?>
    <tr>
        <td><?= $i + 1 ?></td>
        <td><?= Html::encode($model->full_name) ?></td>
        <td><?= Html::encode($model->identity_number) ?></td>
        <td><?= Html::encode($model->phone) ?></td>
        <td><?= Html::encode($model->email) ?></td>
        <td>
            <div class="dropdown">
                <button class="btn btn-sm" type="button" data-bs-toggle="dropdown" aria-expanded="false">⋮</button>
                <ul class="dropdown-menu text-end shadow-sm">
                    <li><?= Html::button('عرض', ['value' => Url::to(['view', 'id' => $model->id]), 'class' => 'dropdown-item showModalButton']) ?>
                    </li>
                    <li><?= Html::button('تعديل', ['value' => Url::to(['update', 'id' => $model->id]), 'class' => 'dropdown-item showModalButton']) ?>
                    </li>
                    <li><?= Html::a('حذف', ['delete', 'id' => $model->id], [
                        'class' => 'dropdown-item text-danger',
                        'data' => ['confirm' => 'هل أنت متأكد من الحذف؟', 'method' => 'post'],
                    ]) ?></li>
                </ul>
            </div>
        </td>
    </tr>
<?php endforeach; ?>

<tr>
    <td colspan="6" class="text-center">
        <?= LinkPager::widget([
            'pagination' => $dataProvider->pagination,
            'options' => ['class' => 'pagination rtl-pagination justify-content-center'],
            'linkOptions' => ['class' => 'page-link'],
            'prevPageLabel' => ' السابق',
            'nextPageLabel' => 'التالي ',
            'disabledPageCssClass' => 'page-item disabled',
            'activePageCssClass' => 'active',
            'maxButtonCount' => 7,
        ]) ?>
        <div class="text-center text-muted mt-2 small">
            عرض <?= $dataProvider->getCount() ?> من أصل <?= $dataProvider->getTotalCount() ?> نتيجة
        </div>
    </td>
</tr>