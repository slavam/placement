<?php

namespace app\controllers;

use mdm\admin\components\AccessControl;
use Yii;
use app\models\DocMigration;
use app\models\searches\DocMigrationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * DocMigrationController implements the CRUD actions for DocMigration model.
 */
class DocMigrationController extends Controller
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
     * Lists all DocMigration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocMigrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocMigration model.
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
     * Creates a new DocMigration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocMigration();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Миграционная карта \"$model->fullNum\" успешно добавлена.");
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
     * Updates an existing DocMigration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Миграционная карта \"$model->fullNum\" успешно сохранена.");
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
     * Deletes an existing DocMigration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        try {
            $model->delete();
            Yii::$app->getSession()->addFlash('success', "Миграционная карта \"$model->fullNum\" успешно удалена.");
            return $this->redirect(Yii::$app->request->referrer);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            Yii::$app->getSession()->addFlash('error', "<strong>Не удалось удалить миграционную карту \"$model->fullNum\":<br></strong>".$msg);
            return $this->redirect(Yii::$app->request->referrer);
        }
        //return $this->redirect(['index']);
    }

    /**
     * Finds the DocMigration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocMigration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocMigration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
