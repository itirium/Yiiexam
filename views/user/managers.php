<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use app\models\User;

$this->title = 'Управління користувачами';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
<h1><?= Html::encode($this->title) ?></h1>
<?php
    $dataProvider = new ActiveDataProvider([
    'query' => User::find(),
    'pagination' => [
        'pageSize' => 20,
    ],
    ]);    
?>        
    
<div class="row">
    <div class="col-xs-12 col-md-8"></div>
    <div class="col-xs-6 col-md-4">
<?=Html::beginForm(['user/managers'],'post');?>
<?=Html::dropDownList('action','',[''=>'Змінити вибранних: ','1'=>'Менеджер','0'=>'Користувач'],['class'=>'dropdown',])?>
<?=Html::submitButton('Застосувати', ['class' => 'btn btn-info',]);?>
    </div>
</div>  
        
<?=GridView::widget([
'dataProvider' => $dataProvider,
'columns' => [    
    'id',
    'username',
    'email',
    [
        'label' =>'Менеджер',
        'format' => 'raw',
        'attribute' => 'ismanager',
        'value' => function ($model, $index, $widget) {
          return Html::checkbox('ismanager[]', $model->ismanager,
        ['value' => $index, 'disabled' => true]);
    },
    ],
    [
        'class'=>'yii\grid\CheckboxColumn',
        'header'=>'Вибрати',
    ],
],
]); 
?>
<?= Html::endForm();?> 
        
        
        

</div>
