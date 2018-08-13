<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//$this->title = 'Login';
//$this->params['breadcrumbs'][] = $this->title;
?>
<?php
$fieldOptions1 = [
'options' => ['class' => 'form-group has-feedback'],
'inputTemplate' => "<span class='glyphicon glyphicon-user form-control-feedback'></span>{input}"
];

$fieldOptions2 = [
'options' => ['class' => 'form-group has-feedback'],
'inputTemplate' => "<span class='glyphicon glyphicon-lock form-control-feedback'></span>{input}"
];
?>


<div class="account-pages"></div>
<div class="clearfix"></div>
<div class="wrapper-page">
    <div class="text-center">
        <a href="<?=Yii::$app->urlManager->getBaseUrl()?>" class="logo"><span>Smart<span>Presence</span></span></a>
        <h5 class="text-muted m-t-0 font-600">Assalamualaikum, silahkan login.</h5>
    </div>
    <div class="m-t-40 card-box">
        <div class="panel-body">
            <h1><?= Html::encode($this->title) ?></h1>
            <?php //echo Alert::widget(['useSessionFlash'=>true])?>

            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

            <div class="text-center">
                <h4 class="text-uppercase font-bold m-b-0">Sign In</h4>
                <br>
                <br>
            </div>

            <?= $form
                ->field($model, 'username')
                ->label(false)
                ->textInput(['placeholder' => $model->getAttributeLabel('username')]) ?>

            <?= $form
                ->field($model, 'password')
                ->label(false)
                ->passwordInput(['placeholder' => $model->getAttributeLabel('password')]) ?>


            <?php echo $form->field($model, 'rememberMe')->checkbox() ?>

            <div class="form-group">
                <?= Html::submitButton('Login', ['class'=>['btn btn-primary btn-bordred col-xs-12'], 'name' => 'login-button']) ?>
            </div>

            <br>
            <br>

            <div class="form-group m-t-30 m-b-0">
                <div class="col-sm-12">
                    <a href="page-recoverpw.html" class="text-muted"><i class="fa fa-lock m-r-5"></i> Lupa password?</a>
                </div>
            </div>

            <?php ActiveForm::end(); ?>


        </div>

    </div>
    <!-- end card-box-->
</div>
<!-- end wrapper page -->



<script>
    var resizefunc = [];
</script>
<div class="site-login">

</div>
