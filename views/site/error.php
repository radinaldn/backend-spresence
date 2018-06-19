<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = $name;
?>
<div class="site-error">
<!--    -->

    <section id="wrapper" class="error-page">

            <div class="error-body text-center">
                <h3 class="red"><?= Html::encode($this->title) ?></h3>
                <h3 class="text-uppercase"><?= nl2br(Html::encode($message)) ?></h3>
                <p class="text-muted m-t-30 m-b-30">YOU SEEM TO BE TRYING TO FIND HIS WAY HOME</p>
                <a href="<?= Url::to(['index']); ?>" class="btn btn-info btn-rounded waves-effect waves-light m-b-40">Back to home</a> </div>

        </div>
    </section>

</div>
