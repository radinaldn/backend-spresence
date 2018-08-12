<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 10/07/18
 * Time: 5:55
 */

namespace app\api\modules\v1\controllers;


use yii\rest\Controller;
use yii\web\Response;
use Yii;
use app\models\Ruangan;

class RuanganController extends Controller
{
    /*
     * get All Ruangan
     */

    public function actionFindAll(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $response['master'] = Ruangan::find()->all();
        }
        return $response;
    }
}