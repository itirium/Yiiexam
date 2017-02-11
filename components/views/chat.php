<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\db\Query;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;

//use app\controllers\SiteController;
/* @var $this yii\web\View */


$this->params['breadcrumbs'][] = $this->title;
?>
<div class="form-chat" >
    <p></p>
    
<?= Html::beginForm(['postmessage'], 'post', ['data-pjax' => '', 'class' => 'form-chat']); ?>    
<?= (Yii::$app->user->isGuest)? '' : Html::input('text', 'string', Yii::$app->request->post('string'), ['class' => 'form-control']);?>
<?= (Yii::$app->user->isGuest)? '' :Html::submitButton('Тиць', ['class' => 'btn btn-lg btn-primary', 'name' => 'hash-button']); ?>
<?= Html::endForm() ?>
    </div>
<h3>Відгуки</h3>

    <div class="messages" style="overflow: auto; max-height: 250px;">
<?php Pjax::begin(); ?>
<?php
    $querypost= new Query();
    $querypost-> 
            select('post.created_at as `dt`, profile.first_name as `uname`, post.post as `message`')
            ->from('post')
            ->innerJoin('profile', '`profile`.`user_id` = `post`.`user_id`')
            ->orderBy(['post.created_at'=>SORT_ASC]);   
    $pst = $querypost->createCommand()->queryAll();
    
        
    foreach($pst as $mess){
    echo '<p>'.$mess['uname'].' : <i>'.$mess['message'].'</i></p>';
   };   
?>
    </div>

<?php Pjax::end(); ?>
