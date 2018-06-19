<?php

namespace app\api\modules\v1\controllers;

/**
 * Created by PhpStorm.
 * User: radinaldn
 * Date: 09/06/18
 * Time: 5:58
 */

use app\models\Mahasiswa;
use yii\rest\Controller;
use yii\web\Response;
use Yii;

class MahasiswaController extends Controller
{
    public function actionFindAll(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isGet){
            $response['master'] = Mahasiswa::find()
                                            ->innerJoinWith('jurusan', false)
                                            ->all();

            
        }
        return $response;
    }

    public function actionLogin(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $response = null;

        if(Yii::$app->request->isPost){
            $data = Yii::$app->request->post();
            $password = sha1($data['password']);

            $user = Mahasiswa::find()
                ->where(['nim' => $data['username']])
                ->andWhere(['password' => $password])
                ->andWhere(['imei' => $data['imei']])
                ->all();


            if(isset($user)){
                if($user==null){
                    $response['status'] = 'invalid username or password ';
                    $response['data'] = $user;
                } else {
                    $response['status'] = 'success';
                    $response['data'] = $user;
                }

            } else {
                $response['status'] = 'login failed';
            }
        }

        return $response;
    }
}