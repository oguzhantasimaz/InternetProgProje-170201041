<?php

namespace kouosl\notetaking\controllers\backend;

use Yii;
use kouosl\notetaking\controllers\backend\KeywordsController;
use kouosl\notetaking\models\NotetakingNotes;
use kouosl\notetaking\models\NotetakingNotesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use kouosl\notetaking\models\NotetakingKeywords;
use kouosl\notetaking\Module;
use kouosl\site\controllers\backend\AuthController; 

class NotesController extends Controller
{ 
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
    //
    /**
     * Lists all NotetakingNotes models.
     * @return mixed
     */
    public function actionIndex()
    {

        if(!Yii::$app->authManager->getRolesByUser(Yii::$app->user->getId())=='user')
        {
        $auth = Yii::$app->authManager;
        $userRole = $auth->getRole('user');
        $auth->assign($userRole, Yii::$app->user->getId());
        }
    
        $searchModel = new NotetakingNotesSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        if (!Yii::$app->user->isGuest) {
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);}
        else{
            return $this->goBack();
        }
    }

    /**
     * Displays a single NotetakingNotes model.
     * @param integer $user_id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($user_id,$id)
    {
        if (!Yii::$app->user->can('seeAllNotes')) $user_id=Yii::$app->user->getId() ;
        return $this->render('view', [
            'model' => $this->findModel($user_id, $id),
        ]);
    }

    public function actionAddkey( $id,$user_id)
    {   
        if (!Yii::$app->user->can('seeAllNotes')) $user_id=Yii::$app->user->getId() ;
  
        if (Yii::$app->user->can('updateNote')){
        $model = $this->findModel($user_id, $id);
        $modelkey = new NotetakingKeywords();

        if ($modelkey->load(Yii::$app->request->post()) && $modelkey->save()) {
            $modelkey = new NotetakingKeywords();
            Yii::$app->session->setFlash('success', Module::t('notetaking', 'Keyword added successfully !'));
            return $this->render('addKey', [
                'model' => $model,'modelkey'=>$modelkey,
            ]);
        }
        
        return $this->render('addKey', [
            'model' => $model,'modelkey'=>$modelkey,
        ]);
    }else return $this->goBack();
    }


    public function actionDeletekey($not_id, $key,$user_id)
    {
       
        KeywordsController::findModel($not_id, $key)->delete();
        
        if (Yii::$app->user->can('updateNote')){

        if (!Yii::$app->user->can('seeAllNotes')) $user_id=Yii::$app->user->getId() ;
        
        $model = $this->findModel($user_id, $not_id);
        $modelkey = new NotetakingKeywords();
        Yii::$app->session->setFlash('success', Module::t('notetaking', 'Keyword deleted successfully !'));
        
        return $this->render('addKey', [
            'model' => $model,'modelkey'=>$modelkey,
        ]);}
        else return $this->goBack();
    }

    /**
     * Creates a new NotetakingNotes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new NotetakingNotes();
       
        if (Yii::$app->user->can('createNote')){

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            
            return $this->redirect(['view', 'user_id' => $model->user_id, 'id' => $model->id]);
        }
     
        return $this->render('create', [
            'model' => $model,
        ]);
    }else $this->goBack();

}

    public function actionSearch()
    {
        $model = new NotetakingNotes();

        return $this->render('search', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing NotetakingNotes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($user_id, $id)
    {

        if (!Yii::$app->user->can('seeAllNotes')) $user_id=Yii::$app->user->getId() ;
        $model = $this->findModel($user_id, $id);
        
        if (Yii::$app->user->can('updateNote')){
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);}else return $this->goBack();
    }

    /**
     * Deletes an existing NotetakingNotes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($user_id, $id)
    {
        if (!Yii::$app->user->can('seeAllNotes')) $user_id=Yii::$app->user->getId() ;

        if (Yii::$app->user->can('deleteNote')){
        $this->findModel($user_id, $id)->delete();

        return $this->redirect(['index']);}else return $this->goBack();
    }

    /**
     * Finds the NotetakingNotes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $id
     * @return NotetakingNotes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $id)
    {   
        if (!Yii::$app->user->can('seeAllNotes')) $user_id=Yii::$app->user->getId() ;
        
        if (($model = NotetakingNotes::findOne(['user_id' => $user_id, 'id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
