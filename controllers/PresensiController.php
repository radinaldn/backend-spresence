<?php

namespace app\controllers;

use app\models\Mengajar;
use Yii;
use app\models\Presensi;
use app\models\PresensiSearch;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\data\SqlDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PresensiController implements the CRUD actions for Presensi model.
 */
class PresensiController extends Controller
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
     * Lists all Presensi models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresensiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Menampilkan data histori mengajar berdasarka inputan id_mengajar
     */

    public function actionHistoriMengajarByIdMengajar($id){

        $searchModel = new PresensiSearch();

        $sql = "SELECT tb_presensi.id_presensi,
                    (SELECT COUNT(nim) FROM tb_presensi_detail WHERE tb_presensi_detail.status = \"Hadir\" AND tb_presensi_detail.id_presensi = tb_presensi.id_presensi) as total_hadir, 
                    (SELECT COUNT(nim) FROM tb_presensi_detail WHERE tb_presensi_detail.status = \"Tidak Hadir\" AND tb_presensi_detail.id_presensi = tb_presensi.id_presensi) as total_tidak_hadir, 
                    tb_dosen.nama as nama_dosen, tb_matakuliah.nama as nama_matakuliah,
                    tb_presensi.pertemuan, tb_presensi.status, tb_kelas.nama as kelas, tb_ruangan.nama as nama_ruangan, DATE_FORMAT(tb_presensi.waktu, '%d %b %Y %T') as waktu 
                    FROM tb_presensi INNER JOIN tb_mengajar, tb_dosen, tb_matakuliah, tb_kelas, tb_ruangan 
                    WHERE tb_presensi.id_mengajar = tb_mengajar.id_mengajar 
                    AND tb_mengajar.nip = tb_dosen.nip 
                    AND tb_mengajar.id_matakuliah = tb_matakuliah.id_matakuliah 
                    AND tb_mengajar.id_kelas = tb_kelas.id_kelas 
                    AND tb_presensi.id_ruangan = tb_ruangan.id_ruangan
                    AND tb_presensi.id_mengajar = '$id'
                    ORDER BY tb_presensi.waktu DESC";

//
        $dataProvider = new SqlDataProvider(['sql' => $sql]);

        $modelMengajar = Mengajar::find()->where(['id_mengajar' => $id])->one();



        return $this->render('histori-mengajar-by-id-mengajar', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'modelMengajar' => $modelMengajar,
        ]);
    }


    /**
     * Displays a single Presensi model.
     * @param string $id
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
     * Creates a new Presensi model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Presensi();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_presensi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Presensi model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_presensi]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Presensi model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Presensi model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Presensi the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Presensi::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
