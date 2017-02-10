<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<img src="img/brand.png" height="30px"/>',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-fixed-top',
            'renderInnerContainer'=>false
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Магазин', 'url' => ['/site/index']],
            ['label' => 'Доставка і оплата', 'url' => ['/site/about']],
            ['label' => 'Зворотній зв`язок', 'url' => ['/site/contact']],
            Yii::$app->user->isGuest ? (
                    ['label'=>'Реєстрація', 'url'=>['/user/reg']]
                    ):(''),
            
            Yii::$app->user->isGuest ? (
                ['label' => 'Вхід', 'url' => ['/user/login']]
            ) : (   
                    [
                        'label'=>Yii::$app->user->identity['username'],
                        'url'=>'',                        
                        'items'=>
                        [
                            ['label' => '<span>&nbsp</span>','encode'=>false],                            
                            ['label'=>'Профіль',
                                'url'=>['/user/profile'],
                                'linkOptions'=>['data-method'=>'post']],
                            ['label' => '<span>&nbsp</span>','encode'=>false],
                            Yii::$app->user->identity['ismanager']?(                           
                                ['label'=>'Редагувати товар',
                                'url'=>['/item/index'],
                                'linkOptions'=>['data-method'=>'post']
                            ]):(''),
                            Yii::$app->user->identity['ismanager']?(                           
                                ['label'=>'Керування користувачами',
                                'url'=>['/user/managers'],
                                'linkOptions'=>['data-method'=>'post']
                            ]):(''),
                            ['label' => '<span>&nbsp</span>','encode'=>false],
                            ['label'=>'Вихід',
                                'url'=>['/user/logout'],
                                'linkOptions'=>['data-method'=>'post']]
                        ]
                    ]
                )            
        ],
    ]);
    NavBar::end();
    ?>
 
    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div> 
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Paracordium.ua <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?> і виплакано потом мною))</p>
    </div>
</footer>

<div class="modal fade" tabindex="-1" role="dialog" id="shoppingcart">  
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Додати у кошик</h4>
      </div>
      <div class="modal-body">
          <div class="row">
              
              <div class="col-lg-3">
                  <img src="" id="imgPreview" alt="" width="150">
              </div>                  
              <div class="col-lg-3">
                  <p>Товар: <span id="txtItemName"></span></p>
                  <p>Ціна: <span id="txtItemPrice"></span></p>
                  <p>Опис: <span id="txtItemDescription"></span></p>
                  <input type="hidden" id="itemid"  name="itemid" value="0"/>
                  <input type="number" id="intCount" name="intCount" min="0" max="20" value="1"/>
              </div>
              
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Відбій</button>
        <button type="submit" class="btn btn-primary" data-dismiss="modal" onclick="addtoBacketCart()" >Додати до кошику</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->    
    <script>
        function addtoCart(id){
            img=$('#img_'+id).attr("src");    
            
            txtName=$('#txtItName_'+id).text();
            txtDesc=$('#txtItDesc_'+id).text();
            txtPrice=$('#txtItPrice_'+id).text();
            
            $("#imgPreview").attr({
                'src':img
            });
            $("#txtItemName").text(txtName);
            $("#txtItemDescription").text(txtDesc);
            $("#txtItemPrice").text(txtPrice);
            $('#itemid').val(id);
            $('#intCount').val(1);
            $('#shoppingcart').modal();            
        }
        function addtoBacketCart(){            
            
            itemid=$('#itemid').val();
            itemcount=$('#intCount').val();
            if(itemcount>0)
            {
            $.get('<?=Yii::$app->homeUrl ?>?r=item%2Faddtobacket/' ,{'id' : itemid , 'count' : itemcount}, function(data){});
            $('#myBlock').load('<?=Yii::$app->homeUrl ?>?r=site%2Fshowcart');
            }
            else{
                alert("Введіть правильну кількість товару!");
            }
        }
        
        
        
    </script>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
