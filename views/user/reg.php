<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model app\models\RegForm */
/* @var $form ActiveForm */
$this->title = 'Реєстрація нового користувача';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="main-reg">
<h1><?= Html::encode($this->title) ?></h1>
<div class="row">
            <div class="col-lg-5">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'username') ?>
        <?= $form->field($model, 'email') ?>
        <?= $form->field($model, 'password')->passwordInput() ?>
        <?= $form->field($model, 'password_repeat')->passwordInput() ?>

        <div class="form-group">
            <?= Html::submitButton('Зареєструватись', ['class' => 'btn btn-primary']) ?>
        </div>
    <?php ActiveForm::end(); ?>
            </div>
</div>
</div><!-- main-reg -->