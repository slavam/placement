<?php

namespace app\controllers;

use app\models\Address;
use mdm\admin\components\AccessControl;
use Yii;
use app\models\DocRegistration;
use app\models\searches\DocRegistrationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Url;

/**
 * DocRegistrationController implements the CRUD actions for DocRegistration model.
 */
class DocRegistrationController extends Controller
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
     * Lists all DocRegistration models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new DocRegistrationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DocRegistration model.
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
     * Creates a new DocRegistration model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new DocRegistration();
        $address = new Address();

        if ($model->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Регистрация \"$model->fullNum\" успешно добавлена.");
            return $this->redirect(Url::previous() != Yii::$app->homeUrl ? Url::previous() : ['view',  'id' => $model->id]);
        } else {
            if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl)
                Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
            if (!Yii::$app->request->isPost)
                $model->setAttributes(Yii::$app->request->get());
            return $this->render('create', [
                'model' => $model,
                'address' => $address,
            ]);
        }
    }

    /**
     * Updates an existing DocRegistration model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $address = $model->address ? $model->address : new Address();

        if ($model->load(Yii::$app->request->post()) && $address->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->getSession()->addFlash('success', "Регистрация \"$model->fullNum\" успешно сохранена.");
            return $this->redirect(Url::previous() != Yii::$app->homeUrl ? Url::previous() : ['view', 'id' => $model->id]);
        } else {
            if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl)
                Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
            return $this->render('update', [
                'model' => $model,
                'address' => $address,
            ]);
        }
    }

    /**
     * Deletes an existing DocRegistration model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $model=$this->findModel($id);
        try {
            $model->delete();
            Yii::$app->getSession()->addFlash('success', "Регистрация \"$model->fullNum\" успешно удалена.");
            return $this->redirect(Yii::$app->request->referrer);
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            Yii::$app->getSession()->addFlash('error', "<strong>Не удалось удалить регистрацию \"$model->fullNum\":<br></strong>".$msg);
            return $this->redirect(Yii::$app->request->referrer);
        }
        //return $this->redirect(['index']);
    }

    /**
     * Finds the DocRegistration model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return DocRegistration the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = DocRegistration::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
