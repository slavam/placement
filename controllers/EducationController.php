<?php

namespace app\controllers;

use mdm\admin\components\AccessControl;
use Yii;
use app\models\Education;
use app\models\searches\EducationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * EducationController implements the CRUD actions for Education model.
 */
class EducationController extends Controller
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
     * Lists all Education models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EducationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Education model.
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
     * Creates a new Education model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Education();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Запись #$model->id успешно добавлена.");
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
     * Updates an existing Education model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Запись #$model->id успешно сохранена.");
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
     * Deletes an existing Education model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        try {
            $model->delete();
            Yii::$app->getSession()->addFlash('success', "Запись #$model->id успешно удалена.");
            return $this->redirect(Yii::$app->request->referrer);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            Yii::$app->getSession()->addFlash('error', "<strong>Не удалось удалить запись #$model->id:<br></strong>".$msg);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(['index']);
    }

    protected function renderGrid()
    {
        $searchModel = new EducationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $dataProvider->sort->route = Url::toRoute(['index']);

        $method = Yii::$app->request->isAjax ? 'renderAjax' : 'render';

        return $this->$method('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Finds the Education model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Education the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Education::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
