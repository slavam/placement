<?php

namespace app\controllers;

use mdm\admin\components\AccessControl;
use Yii;
use app\models\DocExam;
use app\models\searches\DocExamSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * DocExamController implements the CRUD actions for DocExam model.
 */
class DocExamController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all DocExam models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocExamSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocExam model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new DocExam model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocExam();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Экзамен \"$model->fullNum\" успешно добавлен.");
            return $this->redirect(Url::previous() != Yii::$app->homeUrl ? Url::previous() : ['view',  'id' => $model->id]);
        } else {
            if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl)
                Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
            if (!Yii::$app->request->isPost)
                $model->setAttributes(Yii::$app->request->get());
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing DocExam model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Экзамен \"$model->fullNum\" успешно сохранен.");
            return $this->redirect(Url::previous() != Yii::$app->homeUrl ? Url::previous() : ['view', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl)
                Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing DocExam model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        try {
            $model->delete();
            Yii::$app->getSession()->addFlash('success', "Экзамен \"$model->fullNum\" успешно удален.");
            return $this->redirect(Yii::$app->request->referrer);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            Yii::$app->getSession()->addFlash('error', "<strong>Не удалось удалить экзамен \"$model->fullNum\":<br></strong>".$msg);
            return $this->redirect(Yii::$app->request->referrer);
        }
        //return $this->redirect(['index']);
    }

    /**
     * Finds the DocExam model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocExam the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocExam::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
