<?php

namespace backend\controllers;

use backend\models\UploadForm;
use common\models\Imagem;
use common\models\ImagemSearch;
use common\models\motociclo;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;



/**
 * ImagemController implements the CRUD actions for Imagem model.
 */
class ImagemController extends Controller
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
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'actions' => ['index', 'view','update', 'create', 'delete'],
                            'allow' => true,
                            'roles' => ['gestor','admin'],
                        ],
                    ],
                    'denyCallback' => function ($rule, $action) {
                        Yii::$app->user->logout();
                        return $this->redirect(['site/login']);
                    }
                ],
            ]
        );
    }

    /**
     * Lists all Imagem models.
     *
     * @return string
     */
    public function actionIndex($idmotociclo)
    {
        $model = Imagem::find()->all();
        $motociclo = motociclo::findOne($idmotociclo);
        $dataProvider = new ActiveDataProvider([
            'query' => $motociclo->getImagems(),
        ]);
        return $this->render('index', [
            'model' => $model,
            'dataProvider' => $dataProvider,
            'motociclo' => $motociclo,

        ]);
    }

    /**
     * Displays a single Imagem model.
     * @param int $id_imagem Id Imagem
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_imagem)
    {
        return $this->render('view', [
            'model' => $this->findModel($id_imagem),
        ]);
    }

    /**
     * Creates a new Imagem model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($idmotociclo)
    {
        if (\Yii::$app->user->can('createImagem')) {

            $model = new Imagem();
            $modelupload = new UploadForm();

            if (Yii::$app->request->isPost) {
                $modelupload->imageFiles = UploadedFile::getInstances($modelupload, 'imageFiles');
                $modelupload->upload();

                foreach ($modelupload->imageFiles as $image) {

                    $modelimage = new Imagem();
                    $modelimage->imagem = $image->baseName . '.' . $image->extension;
                    $modelimage->motociclo_id = $idmotociclo;
                    $modelimage->save();
                }
                return $this->redirect(['index', 'idmotociclo' => $idmotociclo]);

            }

            return $this->render('update', ['model' => $model, 'modelupload' => $modelupload,
            ]);
        }else {
            Yii::$app->user->logout();
            return  $this ->redirect(['site/login']);
        }
    }

    /**
     * Updates an existing Imagem model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_imagem Id Imagem
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_imagem)
    {
        $model = $this->findModel($id_imagem);
        $modelupload = new UploadForm();

        if (Yii::$app->request->isPost) {
            $modelupload->imageFiles = UploadedFile::getInstances($modelupload, 'imageFiles');
            $modelupload->upload();

            foreach ($modelupload->imageFiles as $image) {

                $modelimage = new Imagem();
                $modelimage->imagem = $image->baseName . '.' . $image->extension;
                $modelimage->motociclo_id = $model->motociclo_id;
                $modelimage->save();
            }
            return $this->redirect(['index', 'idmotociclo' => $model->motociclo_id]);

        }

        return $this->render('update', ['model' => $model, 'modelupload' => $modelupload,
        ]);

    }

    /**
     * Deletes an existing Imagem model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_imagem Id Imagem
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_imagem)
    {
        if (\Yii::$app->user->can('deleteImagem')) {

            $model = $this->findModel($id_imagem);

            $this->findModel($id_imagem)->delete();

            return $this->redirect(['index', 'idmotociclo' => $model->motociclo_id]);
        }
        else {
            Yii::$app->user->logout();
            return  $this ->redirect(['site/login']);
        }
    }

    /**
     * Finds the Imagem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_imagem Id Imagem
     * @return Imagem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_imagem)
    {
        if (($model = Imagem::findOne(['id_imagem' => $id_imagem])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist . ');
    }
}
