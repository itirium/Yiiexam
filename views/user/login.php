<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\LoginForm */
/* @var $form ActiveForm */
$this->title = 'Вхід у систему';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-login">
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
            <div class="col-lg-5">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username') ?>
    <?= $form->field($model, 'password')->passwordInput() ?>
    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Увійти', ['class' => 'btn btn-primary']) ?>
    </div>
    <?php ActiveForm::end(); ?>
            </div>
</div>
</div><!-- main-login -->