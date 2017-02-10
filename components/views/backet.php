<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Backet;
use yii\data\ActiveDataProvider;
use yii\db\Query;
/* @var $this yii\web\View */




$this->title = 'Кошик';
$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Віджет кошику</h3>
<?phpPjax::begin();?>
<?php
//   $cart_query=new Query();
//   $cart_query= Backet::getCartQuery(Yii::$app->user->id);
    $cartbacket= new Query();
    $cartbacket-> 
    select('*')
    ->from('backet')
    ->innerJoin('item', '`item`.`id` = `backet`.`item_id`')
    ->where(['backet.user_id' => Yii::$app->user->id])    
    ->all();
    
    $cartsum= $cartbacket->sum('count*price');
    $cartcount=$cartbacket->sum('count');
    
   $dataProvider = new ActiveDataProvider([
    'query' => $cartbacket,
    'pagination' => [
        'pageSize' => 20,
    ],
    ]); 
?>
<div class="item-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?=             
        GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [            
            [
                'label' =>'Товар',
                'attribute' => 'name',
            ],
            [
                'label' =>'Ціна',
                'attribute' => 'price',
            ],
            [
                'label' =>'К-сть',
                'attribute' => 'count',
            ]
        ],
    ]); 
     ?>    
</div>

<div>Усього товару: <?= $cartcount;?> <br /> на сумму <b><?= number_format($cartsum,2,'.','');?> </b></div>

<?phpPjax::end();?>