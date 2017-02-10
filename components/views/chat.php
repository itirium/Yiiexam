<?php
use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use app\models\Post;
use app\models\Postchat;
use yii\helpers\Html;
?>

<h3>Віджет чату</h3>

<?phpPjax::begin();?>


<div><h1>Post:</h1></div>
<?php
        $posts=Post::find()->all();
        foreach ($posts as $post) {
            echo "<b>$post->id | $post->messagedt</b>&nbsp<i>$post->user_id</i>: $post->post<br />";
        }
        if (Yii::$app->user->isGuest) {
              echo '<p class="lead" style="color: red;">You need to Login to post a messages.</p>';
        }
?>

<?php $form=ActiveForm::begin(['id'=>'postchat']); ?>

 <?=$form->field($model,'post')->textInput(['autofocus'=>true])?>
<div>
    <button type="submit" class="btn btn-primary">Post</button>
</div>

<?php
    ActiveForm::end();
?>

<?phpPjax::end();?>