<?php

namespace app\controllers;

use app\models\Address;
use app\models\Person;
use mdm\admin\components\AccessControl;
use Yii;
use app\models\Resume;
use app\models\searches\ResumeSearch;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\ForbiddenHttpException;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ResumeController implements the CRUD actions for Resume model.
 */
class ResumeController extends Controller
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
     * Lists all Resume models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ResumeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        // Жадная загрузка
        // $dataProvider->query->joinWith(['resumeProfessions']);
        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Resume model.
     * @param $id
     * @param null $at
     * @return string
     * @throws ForbiddenHttpException
     */
    public function actionView($id, $at = null)
    {
        if (!\Yii::$app->user->can('/resume/view'))
            throw new ForbiddenHttpException('У вас недостаточно прав для данного действия.');

        return $this->render('view', [
            'model' => $this->findModel($id),
            'at' => $at,
        ]);
    }

    /**
     * Creates a new Resume model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        return $this->loadAndSave('create');
    }

    /**
     * Updates an existing Resume model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionUpdate($id)
    {
        if (!\Yii::$app->user->can('/resume/update', ['model' => $this->findModel($id)]))
            throw new ForbiddenHttpException('У вас недостаточно прав для данного действия.');

        return $this->loadAndSave('update', $id);
    }

    public function loadAndSave($actionName, $id = null)
    {
        $model = $id ? $this->findModel($id) : new Resume();
//        $model->scenario = $actionName;
        $person = $model->person ? $model->person : new Person();
        $person_address = $person->address ? $person->address : new Address();

        //Подставляем значения по умолчанию в пустые поля
        if ($model->workplace_id === null) $model->workplace_id = \app\models\User::findOne(Yii::$app->user->id)->workplace_id;

        $ok = false;
        if (Yii::$app->request->isPost) {
            $ok = true;
            if (!$model->load(Yii::$app->request->post())) $ok = false;
            if (!$person->load(Yii::$app->request->post())) $ok = false;
            if (!$person_address->load(Yii::$app->request->post())) $ok = false;
            if (!$model->validate()) $ok = false;
            if (!$person->validate()) $ok = false;
            if (!$person_address->validate()) $ok = false;
        }

        if ($ok) {
            $trans = Yii::$app->db->beginTransaction();
            $person_address->save();
            $person->address_id = $person_address->id;
            $person->save();
            $model->person_id = $person->id;
            $model->save();
            $trans->commit();
            if ($actionName == 'create')
                Yii::$app->getSession()->addFlash('success', "Запись #$model->id успешно добавлена.");
            else
                Yii::$app->getSession()->addFlash('success', "Запись #$model->id успешно сохранена.");
            return $this->redirect(Url::previous() != Yii::$app->homeUrl ? Url::previous() : ['view', 'id' => $model->id]);
        } else {
//            if (Yii::$app->request->isAjax) {
//                Yii::$app->response->format = 'json';
//                return \yii\widgets\ActiveForm::validate($model);
//            }
            if (Yii::$app->request->referrer != Yii::$app->request->absoluteUrl)
                Url::remember(Yii::$app->request->referrer ? Yii::$app->request->referrer : null);
            return $this->render($actionName, [
                'model' => $model,
                'person' => $person,
                'person_address' => $person_address,
            ]);
        }
    }

//    public function actionAv($actionName = 'create', $id = null)
//    {
//        if (Yii::$app->request->isAjax) {
//            Yii::$app->response->format = 'json';
//
//            $model = $id ? $this->findModel($id) : new Resume();
////            $model->scenario = $actionName;
//            $person = $model->person ? $model->person : new Person();
//            $person_address = $person->address ? $person->address : new Address();
//
//            //Подставляем значения по умолчанию в пустые поля
//            if ($model->workplace_id === null) $model->workplace_id = \app\models\User::findOne(Yii::$app->user->id)->workplace_id;
//
//            if ($model->load(Yii::$app->request->post())
//                && $person->load(Yii::$app->request->post())
//                && $person_address->load(Yii::$app->request->post())
//            ) {
//
//                return array_merge(
//                    \yii\widgets\ActiveForm::validate($model),
//                    \yii\widgets\ActiveForm::validate($person)
//                );
//            }
//        }
//    }

    /**
     * Deletes an existing Resume model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws ForbiddenHttpException
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if (!\Yii::$app->user->can('/resume/delete', ['model' => $model]))
            throw new ForbiddenHttpException('У вас недостаточно прав для данного действия.');

        try {
            $model->delete();
            Yii::$app->getSession()->addFlash('success', "Запись #$model->id успешно удалена.");
        } catch (\Exception $e) {
            $msg = (isset($e->errorInfo[2])) ? $e->errorInfo[2] : $e->getMessage();
            Yii::$app->getSession()->addFlash('error', "<strong>Не удалось удалить запись #$model->id:<br></strong>" . $msg);
            return $this->redirect(Yii::$app->request->referrer);
        }
        return $this->redirect(['index']);
    }

    /**
     * Finds the Resume model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Resume the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Resume::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
