<?php
/* @var $this yii\web\View */
use app\models\Item;
use yii\helpers\Html;
use yii\grid\GridView;
$this->title = 'Товари';
$this->params['breadcrumbs'][] = $this->title;
?>
<div>
<h1><?= Html::encode($this->title) ?></h1>  
    
    <?php
    
       foreach (Item::find()->all() as $it) {
       echo "<p> $it->name -  $it->price - $it->description  </p>";
     } 
     ?>  
 
</div>
