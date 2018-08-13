<?php

namespace app\controllers;

use Yii;
use app\models\Mengajar;
use app\models\MengajarSearch;
use yii\data\ActiveDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * MengajarController implements the CRUD actions for Mengajar model.
 */
class MengajarController extends Controller
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
     * Lists all Mengajar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $sql = "SELECT tb_mengajar.id_mengajar, tb_mengajar.nip, tb_dosen.nama as dosen, tb_dosen.foto,
                    tb_kelas.nama as kelas, DATE_FORMAT(waktu_mulai,'%H:%i:%s') as waktu_mulai, DAYNAME(tb_mengajar.waktu_mulai) 
                    as hari, tb_matakuliah.nama as matakuliah, tb_matakuliah.sks, tb_semester_aktif.status 
                    FROM tb_mengajar INNER JOIN tb_matakuliah, tb_semester_aktif, tb_dosen, tb_kelas 
                    WHERE tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.id_semester_aktif = tb_semester_aktif.id_semester_aktif 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas    
                    AND tb_semester_aktif.status = 'Aktif' 
                    ORDER BY tb_mengajar.waktu_mulai ASC";

        $searchModel = new MengajarSearch();
        $dataProvider = new SqlDataProvider(['sql' => $sql]);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Mengajar model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mengajar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mengajar();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_mengajar]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Mengajar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_mengajar]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Mengajar model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Mengajar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mengajar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mengajar::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
