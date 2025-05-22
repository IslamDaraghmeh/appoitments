<?php
namespace frontend\controllers;

use frontend\models\Visits;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
use yii\web\UploadedFile;

class VisitsController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        $query = Visits::find()->orderBy(['id' => SORT_DESC]);

        $date = Yii::$app->request->get('date');

        // ✅ إذا ما فيه تاريخ في GET، استخدم اليوم كـ default
        if (empty($date)) {
            $date = date('Y-m-d');
        }

        $query->andWhere(['visit_date' => $date]);

        if ($status = Yii::$app->request->get('status')) {
            $query->andWhere(['status' => $status]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 15],
        ]);

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('index', [
                'dataProvider' => $dataProvider,
            ]);
        }

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }


    public function actionView($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', ['model' => $model]);
        }

        return $this->render('view', ['model' => $model]);
    }

    public function actionCreate()
    {
        $model = new Visits();

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {

            $model->status = 'موعد جديد';

            // Handle file upload
            $file = UploadedFile::getInstance($model, 'attachment_path');
            if ($file) {
                $fileName = uniqid('visit_') . '.' . $file->extension;

                $uploadPath = Yii::getAlias('@webroot/uploads/visits/' . $fileName);
                if ($file->saveAs($uploadPath)) {
                    $model->attachment_path = 'uploads/visits/' . $fileName;
                }
            }

            if ($model->save()) {
                if (Yii::$app->request->isAjax) {
                    return 'success';
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', ['model' => $model]);
        }

        return $this->render('create', ['model' => $model]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost && $model->load(Yii::$app->request->post())) {
            if ($model->save()) {
                if (Yii::$app->request->isAjax) {
                    return 'success';
                }
                return $this->redirect(['view', 'id' => $model->id]);
            }
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', ['model' => $model]);
        }

        return $this->render('update', ['model' => $model]);
    }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = Visits::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('الصفحة المطلوبة غير موجودة.');
    }
}
