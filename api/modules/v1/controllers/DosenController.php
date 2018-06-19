<?php
/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 09/06/18
 * Time: 7:07
 */

namespace app\api\modules\v1\controllers;

use app\models\Dosen;
use yii\rest\Controller;
use yii\web\Response;
use Yii;

class DosenController extends Controller
{
    // get all dosen
    public function actionFindAll(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $response['master'] = Dosen::find()->all();
        }
        return $response;
    }

    // login dosen
    public function actionLogin(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $password = sha1($data['password']);

            $user = Dosen::find()
                    ->where(['nip' => $data['username']])
                    ->andWhere(['password' => $password])
                    ->andWhere(['imei' => $data['imei']])
                    ->all();


            if(isset($user)){
                if($user==null){
                    $response['status'] = 'invalid username, password or imei';
                    $response['data'] = $user;
                } else {
                    $response['status'] = 'success';
                    $response['data'] = $user;
                }

            } else {
                $response['status'] = 'failed';
            }
        }

        return $response;
    }

}