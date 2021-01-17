<?php

namespace kouosl\notetaking\controllers\backend;

use Yii;
use kouosl\notetaking\models\NotetakingKeywords;
use kouosl\notetaking\models\NotetakingKeywordsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class KeywordsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all NotetakingKeywords models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotetakingKeywordsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single NotetakingKeywords model.
     * @param string $not_id
     * @param string $key
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($not_id, $key)
    {
        return $this->render('view', [
            'model' => $this->findModel($not_id, $key),
        ]);
    }

    /**
     * Creates a new NotetakingKeywords model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NotetakingKeywords();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'not_id' => $model->not_id, 'key' => $model->key]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NotetakingKeywords model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $not_id
     * @param string $key
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($not_id, $key)
    {
        $model = $this->findModel($not_id, $key);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'not_id' => $model->not_id, 'key' => $model->key]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing NotetakingKeywords model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $not_id
     * @param string $key
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($not_id, $key)
    {
        $this->findModel($not_id, $key)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the NotetakingKeywords model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $not_id
     * @param string $key
     * @return NotetakingKeywords the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($not_id, $key)
    {
        if (($model = NotetakingKeywords::findOne(['not_id' => $not_id, 'key' => $key])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
