<?php

namespace frontend\controllers;

use frontend\models\Visitors;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;
/**
 * VisitorsController implements the CRUD actions for Visitors model.
 */
class VisitorsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Visitors models.
     *
     * @return string
     */
    // public function actionIndex()
    // {
    //     $query = Visitors::find();

    //     if ($search = Yii::$app->request->get('q')) {
    //         $query->andFilterWhere([
    //             'or',
    //             ['like', 'full_name', $search],
    //             ['like', 'identity_number', $search],
    //             ['like', 'phone', $search],
    //             ['like', 'email', $search],
    //         ]);
    //     }

    //     $dataProvider = new ActiveDataProvider([
    //         'query' => $query,
    //         'pagination' => ['pageSize' => 10],
    //     ]);

    //     return $this->render('index', [
    //         'dataProvider' => $dataProvider,
    //     ]);
    // }



    public function actionIndex()
    {
        $query = Visitors::find()->orderBy(['id' => SORT_DESC]);

        if ($search = Yii::$app->request->get('q')) {
            $query->andFilterWhere([
                'or',
                ['like', 'full_name', $search],
                ['like', 'identity_number', $search],
                ['like', 'phone', $search],
                ['like', 'email', $search],
            ]);
        }

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 15],
        ]);

        if (Yii::$app->request->isAjax) {
            return $this->renderPartial('_grid', ['dataProvider' => $dataProvider]);
        }

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }











    /**
     * Displays a single Visitors model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionView($id)
    {
        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('view', ['model' => $this->findModel($id)]);
        }

        return $this->render('view', ['model' => $this->findModel($id)]);
    }

    /**
     * Creates a new Visitors model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Visitors();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->isAjax) {
                return 'success';
            }
            return $this->redirect(['index']);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('create', ['model' => $model]);
        }

        return $this->render('create', ['model' => $model]);
    }

    /**
     * Updates an existing Visitors model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if (Yii::$app->request->isAjax) {
                return 'success';
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        if (Yii::$app->request->isAjax) {
            return $this->renderAjax('update', ['model' => $model]);
        }

        return $this->render('update', ['model' => $model]);
    }


    /**
     * Deletes an existing Visitors model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Visitors model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Visitors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Visitors::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
