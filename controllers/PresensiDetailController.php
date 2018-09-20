<?php

namespace app\controllers;

use app\models\Presensi;
use Yii;
use app\models\PresensiDetail;
use app\models\PresensiDetailSearch;
use yii\data\SqlDataProvider;
use yii\helpers\VarDumper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PresensiDetailController implements the CRUD actions for PresensiDetail model.
 */
class PresensiDetailController extends Controller
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
     * Menampilkan data presensi-detail berdaarkan inputan id_presensi
     */

    public function actionHistoriPresensiByIdPresensi($id){
        $searchModel = new PresensiDetailSearch();

        $sql= "SELECT tb_presensi_detail.id_presensi, tb_presensi_detail.nim,
                    tb_mahasiswa.foto, 
                    tb_mahasiswa.nama as nama_mahasiswa, tb_presensi_detail.status, 
                    tb_presensi_detail.lat, tb_presensi_detail.lng, DATE_FORMAT(tb_presensi_detail.waktu, '%d %b %Y %T') as waktu, 
                    tb_presensi_detail.jarak, tb_presensi_detail.proses
                    FROM tb_presensi_detail INNER JOIN tb_mahasiswa
                    WHERE tb_presensi_detail.nim = tb_mahasiswa.nim
                    AND tb_presensi_detail.id_presensi = '$id'
                    ORDER BY tb_presensi_detail.waktu DESC";

        $dataProvider = new SqlDataProvider(['sql' => $sql]);

        $modelPresensi = Presensi::find()->where(['id_presensi' => $id])->one();

        return $this->render('histori-presensi-by-id-presensi', [
            'searchModel'=>$searchModel,
            'dataProvider'=>$dataProvider,
            'modelPresensi'=>$modelPresensi,
        ]);
    }

    /**
     * Lists all PresensiDetail models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PresensiDetailSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PresensiDetail model.
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
     * Creates a new PresensiDetail model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PresensiDetail();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_presensi]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing PresensiDetail model.
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
     * Deletes an existing PresensiDetail model.
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
     * Finds the PresensiDetail model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return PresensiDetail the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PresensiDetail::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
