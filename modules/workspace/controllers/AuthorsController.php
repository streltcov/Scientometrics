<?php

namespace app\modules\workspace\controllers;

// project classes
use app\models\identity\Authors;
// yii classes
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * AuthorsController implements the CRUD actions for Authors model.
 */
class AuthorsController extends Controller
{
    /**
     * @inheritdoc
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
    } // end function


    /**
     * Lists all Authors models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Authors::find(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    } // end action


    /**
     * Displays a single Authors model;
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $author = Authors::find()->where(['id' => $id])->one();
        return $this->render('view', [
            //'model' => $this->findModel($id),
            'model' => $author
        ]);
    } // end action


    /**
     * Creates a new Authors model;
     * If creation is successful, will redirect to 'view' page;
     *
     * @return mixed
     */
    public function actionCreate()
    {
        if (Yii::$app->access->isAdmin()) {
            $model = new Authors();
            if ($model->load(Yii::$app->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }

            return $this->render('create', [
                'model' => $model,
            ]);
        } else {
            return $this->redirect('/control?denyrequest=1');
        }
    } // end action


    /**
     * Updates an existing Authors model;
     * If update is successful, will redirect to 'view' page;
     *
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    } // end action


    /**
     * Deletes an existing Authors model;
     * If deletion is successful, browser be redirect to 'index' page;
     *
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionDelete($id)
    {
        if (Yii::$app->access->isAdmin()) {
            $this->findModel($id)->delete();
            return $this->redirect(['index']);
        } else {
            return $this->redirect('/control?denyrequest=1');
        }
    } // end action


    /**
     * Finds the Authors model based on its primary key value;
     * If the model is not found, a 404 HTTP exception will be thrown;
     *
     * @param integer $id
     * @return Authors the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Authors::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    } // end function

} // end class
