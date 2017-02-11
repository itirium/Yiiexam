<?php
use yii\widgets\Pjax;
use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Backet;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\grid\ActionColumn;
/* @var $this yii\web\View */

$this->params['breadcrumbs'][] = $this->title;
?>

<h3>Кошик</h3>
<?phpPjax::begin();?>
<?php
//   $cart_query=new Query();
//   $cart_query= Backet::getCartQuery(Yii::$app->user->id);
    $cartbacket= new Query();
    $cartbacket-> 
    select('backet.id as `id`, item.name, item.price, backet.count')
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
            ],
               ['class' => 'yii\grid\ActionColumn',
                  'template'=>'{delete}',
                  'buttons'=>[
                  'delete'=>function ($url, $model) {
                        $customurl=Yii::$app->getUrlManager()->createUrl(['item/delfrombacket','iddel'=>$model['id']]);
                        return \yii\helpers\Html::a( '<span class="glyphicon glyphicon-trash"></span>', $customurl,
                                                ['title' => Yii::t('yii', 'Delete'), 'data-pjax' => '0']);
               },
            ],
              
                   
                            ],
         ]]); 
     ?>    
</div>

<div>Усього товару: <?= number_format($cartcount,0,'.','');?>шт <br /> на сумму <b><?= number_format($cartsum,2,'.','');?>грн </b></div>
<div>
    <?=(Yii::$app->user->isGuest)? '<br /> <h4>Уввійдіть у систему</h4>' :''; ?>
    
    <?= (((is_null($cartcount))||($cartcount==0)))? '<h4>Додайте товар до кошику</h4>' :
            '<button type="button" class="btn btn-success" onclick="placeorder();">Оформити Замовлення</button><br /><button type="button" class="btn btn-danger" onclick="delallfrombacket();">Видалити усе с кошика</button>'; ?>
    
    
</div>
<script>
    function placeorder()
    {
        $.get('<?=Yii::$app->homeUrl ?>?r=item/placeorder', function(data){});
    }
    
    function delallfrombacket()
    {
        $.get('<?=Yii::$app->homeUrl ?>?r=item%2Fdeleteallbacket', function(data){});
    }
</script>
<?phpPjax::end();?>